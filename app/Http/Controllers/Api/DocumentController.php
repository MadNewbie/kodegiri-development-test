<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    //
    public function index()
    {
        $documents = Document::all();

        return new DocumentResource(true, 'Daftar Dokumen', $documents);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_reciever' => 'required',
            'content' => 'required',
            'signin' => 'image|mimes:png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $signing = $request->file('signing');
        $tmp_name = $signing->hashName();
        $signing->move(public_path('signings'), $tmp_name);

        $document = Document::create([
            'email_reciever' => $request->email_reciever,
            'title' => $request->title,
            'body' => $request->body,
            'signing_path' => "signings/{$tmp_name}",
        ]);

        return new DocumentResource(true, 'Data Document Has Been Created', $document);
    }

    public function show($id)
    {
        $document = Document::find($id);

        return new DocumentResource(true, 'Data Document Details', $document);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email_reciever' => 'required',
            'content' => 'required',
            'signin' => 'image|mimes:png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $document = Document::find($id);

        if($request->hasFile('signing')){
            $signing = $request->file('signing');
            $tmp_name = $signing->hashName();
            $signing->move(public_path('signings'), $tmp_name);
            Storage::delete('public/'.$document->signing_path);

            $document->update([
                'email_reciever' => $request->email_reciever,
                'title' => $request->title,
                'body' => $request->body,
                'signing_path' => "signings/{$tmp_name}",
            ]);
        } else {
            $document->update([
                'email_reciever' => $request->email_reciever,
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }

        return new DocumentResource(true, 'Data Document Has Been Updated', $document);
    }

    public function destroy($id)
    {
        $document = Document::find($id);

        Storage::delete('public/'.$document->signing_path);

        $document->delete();

        return new DocumentResource(true, 'Data Document Has Been Deleted', $document);
    }
}
