<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <x-tweet-card :tweet="$tweet" :page="$page"/>
    
    
</x-app-layout>
