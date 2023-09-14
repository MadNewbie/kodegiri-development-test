<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Document') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <table class="auto-table border-collapse border border-slate-500">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">Email Reciever</th>
                                <th class="border border-slate-600">Title</th>
                                <th class="border border-slate-600"><button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create</button></th>
                            </tr>
                        </thead>
                        <tbody id="body-document-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>