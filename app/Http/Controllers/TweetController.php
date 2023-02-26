<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;;

use App\Models\Tweet;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    public function create()
    {
        return view('tweets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        
        // Validation des données de la requête
        $validatedData = $request->validate([
            'text' => 'required|max:500', // limite de 500 caractères pour le texte
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000', // les images doivent être au format JPEG, PNG, JPG ou GIF et avoir une taille maximale de 5 Mo
            // 'videos.*' => 'video|mimetypes:video/mp4|max:100000', // les vidéos doivent être au format MP4 et avoir une taille maximale de 50 Mo
        ]);
        
        // Créer un nouveau tweet
        $tweet = new Tweet([
            'text' => $validatedData['text'],
            'user_id' => auth()->id(),
        ]);
    
        // Ajouter les images au tweet
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->put('image', $image);
                $tweet->img = $path;
            }
        }
    
        // Ajouter les vidéos au tweet
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = Storage::disk('public')->put('video', $video);
                $tweet->video = $path;
            }
        }
        
        // Sauvegarder le tweet
        $tweet->save();
    
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
