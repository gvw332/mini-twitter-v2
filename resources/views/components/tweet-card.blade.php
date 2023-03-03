<a class=" bg-red-300" href="{{ url('tweet/' . $tweet->id) }}">
    <div class="mx-auto min-w-300 max-w-800 bg-white shadow-md rounded-md px-4 space-y-2">
        
        <div class="mx-auto p-4 bg-white shadow-md rounded-md px-4 space-y-2">

            <div class="text-xl font-bold">
                {{ $tweet->user->name }}
            </div>

            @if ($tweet->user->avatar != null)
                <img class="mx-auto m-4 w-20 h-20 rounded-full" src=" {{ $tweet->user->avatar }}">
            @else
                "pas d'avatar"
            @endif

        </div>

        <div class="text-gray-700 m-4">
            {{ $tweet->created_at }}
        </div>

        <div class="text-gray-700 m-4">
            {{ $tweet->text }}
        </div>
        <div class="flex gap-4 justify-center">
            <div class="flex justify-center">
                @if ($tweet->img != null)
                    <img class="mx-auto w-300 h-80 m-4" src="{{ Storage::url($tweet->img) }}">
                @endif
            </div>

            <div class="flex justify-center">
                @if ($tweet->video != null)
                    <video class="mx-auto w-300 h-80 m-4" controls>
                        <source src="{{ Storage::url($tweet->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>


        <div class="flex justify-center p-2">

            <a href="{{ url('liked/' . $tweet->id . '?page=' . $page . '#tweet-' . $tweet->id) }}">
                @auth
                    <x-heroicon-s-heart
                        class="w-5 h-5 m-5 {{ $tweet->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-black-500' }} hover:text-red-500" />
                @else
                    <x-heroicon-s-heart class="w-5 h-5 m-5 hover:text-red-500" />
                    {{-- class="w-5 h-5 m-5 {{ $tweet->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-black-500' }} hover:text-red-500" /> --}}

                @endauth
                <div class="text-center">{{ $tweet->likes_count }}</div>
            </a>

            <a href="#">
                <x-heroicon-s-arrows-right-left class="w-5 h-5 m-5 text-gray-500" />
            </a>

            <a href="#">
                <x-heroicon-s-bars-3-center-left class="w-5 h-5 m-5 text-gray-500" />
            </a>

        </div>

    </div>
</a>
