<div class="flex flex-col bg-white shadow-md rounded-md p-4 space-y-2">

    <div class="text-xl font-bold">
        @if ($tweet->user->avatar != null)
            <img class="w-32 h-32 rounded-full" src=" {{ $tweet->user->avatar }}">
        @else 
            "pas d'avatar"
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

    <div class="flex flex-wrap w-500 ">
        @if ($tweet->img != null)        
           <img class="w-300 h-80 m-4" src="{{ $tweet->img }}">

           {{-- {{ $tweet->img }} --}}
           
        @else 
            "pas d'image"
        @endif



    </div>

    <div class="flex">
        <x-heroicon-o-heart class="w-5 h-5 text-gray-500" />
        
    </div>
</div>
