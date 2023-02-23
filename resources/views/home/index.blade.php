<x-guest-layout>
    <div class="text-center">
        @include('layouts.navigation')

        @if(auth()->check()) 
            <div class="m-6 p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4 h-40">
            <input class="w-full h-20 text-center" type="text" name="contenuTweet" placeholder="Quoi de neuf ?">
            <div></div>
            <button class="m-4 p-4 bg-[#a3e635]" type="submit">Diffusez </button>
            </div> 
        @endif


        <div>
            <form class=" bg-[#1da1f2]" action="/search" method="GET">
                <input type="text" name="search" placeholder="Search..">
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
    </div>
</x-guest-layout>
