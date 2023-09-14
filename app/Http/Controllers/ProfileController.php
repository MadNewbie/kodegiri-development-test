<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $request->user()->profile
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $input_profile = $request['profile'];
        // dd($input_profile, $request->user());
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $formatted_name = str_replace(' ','_',$request->user()->name);
        $image_name = "{$formatted_name}_profpic.{$input_profile['photo']->extension()}";
        Storage::delete(public_path('images')."/".$image_name);
        $input_profile['photo']->move(public_path('images'), $image_name);
        $profile = Profile::where('user_id',$request->user()->id)->first() ? : new Profile();
        $input_profile['user_id']=$request->user()->id;
        $input_profile['photo_path']="images/".$image_name;
        $profile->fill($input_profile);
        $profile->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $profpic_path = $user->profile->photo_path;
        Storage::delete(public_path()."/".$profpic_path);
        Auth::logout();


        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function view(Request $request): View
    {
        return view('profile.view', [
            'user' => $request->user(),
            'profile' => $request->user()->profile,
        ]);
    }
}
