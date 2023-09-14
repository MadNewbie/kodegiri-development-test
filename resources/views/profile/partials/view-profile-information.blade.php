<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
    </header>
</section>
<section>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="md:shrink-0">
                <img class="h-48 w-full object-cover md:h-full md:w-48" src="<?=url('')."/".$profile->photo_path?>" alt="profpic">
            </div>
            <div class="p-8">
            <p class="font-semibold">Name</p>
            <p>{{$user->name}}</p>
            <p class="font-semibold">Email Address</p>
            <p>{{$user->email}}</p>
            <p class="font-semibold">Phone</p>
            <p>{{$user->phone}}</p>
            <p class="font-semibold">Company</p>
            <p>{{$profile->company}}</p>
            <p class="font-semibold">Division</p>
            <p>{{$profile->division}}</p>
        </div>
    </div>
</section>
<section>
    <div class="max-w-md mx-auto overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <a href="{{route('profile.edit')}}" class="rounded-md px-3.5 py-2 m-1 overflow-hidden relative group cursor-pointer border-2 font-medium border-indigo-600 text-indigo-600 text-white">
                <span class="absolute w-64 h-0 transition-all duration-300 origin-center rotate-45 -translate-x-20 bg-indigo-600 top-1/2 group-hover:h-64 group-hover:-translate-y-32 ease"></span>
                <span class="relative text-indigo-600 transition duration-300 group-hover:text-white ease">Edit Profile</span>
            </a>
        </div>
    </div>
</section>