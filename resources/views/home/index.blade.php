<x-guest-layout>
    <div class="text-center">
        @include('layouts.navigation')

        @if (auth()->check()) 
            <div class="text-center m-8">    
                <form class="m-8" action="{{ route('addTweet') }}" method="POST" enctype="multipart/form-data">
                    @csrf    
                    <div>                        
                        <textarea class="m-2" name="text" id="text" cols="30" rows="10">{{ old('text') }}</textarea>
                        @error('text')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div>
                        <label for="image">Image :</label>
                        <input type="file" name="image" id="image">
                        @error('image.*')
                            <p class="bg-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="video">Vidéo :</label>
                        <input type="file" name="video" id="video">
                        @error('video.*')
                            <p class="bg-red-400">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <button class="m-4 p-4 bg-[#a3e635]" type="submit">Diffusez</button>
                </form>
        
            </div>
        @endif


        <div>
            <form class=" bg-[#1da1f2]" action="/search" method="GET">
                <input type="text" name="search" placeholder="Recherche..">
                <button type="submit">Recherche</button>
            </form>
        </div>

       
        <div>
            
            @if (isset($notweets)and $notweets)
                <p class="bg-red-400">Aucun tweet trouvé pour la recherche "{{ $search }}".</p>
            @endif

            <ul class="flex flex-col space-y-4">
               
                
                @foreach ($tweets as $tweet)                    
                    <li id="tweet-{{$tweet->id}}" class="flex flex-col">                       
                        <x-tweet-card :tweet="$tweet" :page="$page" />
                    </li>
                @endforeach
            </ul>


            <div class="mt-4">
                {{ $tweets->links() }}
            </div>

        </div>
    </div>
</x-guest-layout>


