<div class=" mx-96 bg-white shadow-md rounded-md px-4 space-y-2">

    <div class="mx-auto p-4 bg-white shadow-md rounded-md px-4 space-y-2">

        <div class="text-xl font-bold">
            {{ $tweet->user->name }}
        </div>


        @if ($tweet->user->avatar != null)
            <img class="mx-auto m-4 w-40 h-48 rounded-full" src=" {{ $tweet->user->avatar }}">
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

    <div class="flex justify-center">
        @if ($tweet->img != null)
            <img class="mx-auto w-300 h-80 m-4" src="{{ $tweet->img }}">

            {{-- {{ $tweet->img }} --}}
        @else
            "pas d'image"
        @endif



    </div>
    <div class="flex justify-center p-2">
        <x-heroicon-o-heart class="w-5 h-5 m-5 text-gray-500" />
        <x-heroicon-s-arrows-right-left class="w-5 h-5 m-5 text-gray-500" />
        <x-heroicon-s-bars-3-center-left class="w-5 h-5 m-5 text-gray-500" />
    </div>

</div>


{{-- <div class="flex flex-col bg-white shadow-md rounded-md p-4 space-y-2 items-center">

    <div class="flex items-center">
        @if ($tweet->user->avatar != null)
            <img class="w-32 h-32 rounded-full mr-4" src="{{ $tweet->user->avatar }}">
        @else 
            <div class="w-32 h-32 bg-gray-500 rounded-full mr-4"></div>
        @endif

        <div class="text-xl font-bold">
            {{ $tweet->user->name }}
        </div>
    </div>

    <div class="text-gray-700">
        {{ $tweet->created_at}} 
    </div>

    <div class="text-gray-700">
        {{ $tweet->text }}
    </div>

    <div class="flex">
        @if ($tweet->img != null)
           <div class="mx-auto">
               <img class="w-1/2 h-80" src="{{ $tweet->img }}">
           </div>
        @else 
            <div class="w-1/2 bg-gray-500 h-80"></div>
        @endif

        <div class="flex-1">
            //Partie droite du bloc ici 
        </div>
    </div>

    <div class="flex sticky top-0">
        <x-heroicon-o-heart class="w-5 h-5 text-gray-500" />
    </div>
</div> --}}
