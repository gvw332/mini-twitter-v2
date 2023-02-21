<x-app-layout>
  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- <x-guest-layout>
    @include('layouts.navigation')
    <div>
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div>
        
        <ul class="flex flex-col space-y-4">
            @foreach ($tweets as $tweet)
                <li class="flex flex-col ">
                    <x-tweet-card :tweet="$tweet" />
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $tweets->links() }}
        </div>
    </div>

</x-guest-layout> --}}
