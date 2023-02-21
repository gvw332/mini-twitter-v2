<x-guest-layout>
    <div class="text-center">
        @include('layouts.navigation')

        <div class="mt-8 border h-40">
            <p>Qu'avez vous fait aujourd'hui?</p>
            <input class="w-full h-20 text-center" type="text" name="contenuTweet" placeholder="Quoi de neuf ?">
            <button class="p-4 bg-[#a3e635]" type="submit">Tweetez</button>
        </div>

        <div>
            <form class="p-4 bg-[#1da1f2]" action="/search" method="GET">
                <input type="text" name="search" placeholder="Search tweet or tweeter">
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
