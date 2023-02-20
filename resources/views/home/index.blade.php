<x-guest-layout>
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


</x-guest-layout>
