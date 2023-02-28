<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'text' => 'required|max:500',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000', // validate each image
                'video.*' => 'video|mimes:mp4',
            ]);

            // Créer un nouveau tweet
            $tweet = new Tweet([
                'text' => $validatedData['text'],
                'user_id' => auth()->id(),
            ]);

            // Ajouter l'image au tweet
            if ($request->hasFile('image')) {
                $path = Storage::disk('public')->put('img-tweet', $request->image);
                $tweet->img = $path;
            }

            // Ajouter les vidéos au tweet
            if ($request->hasFile('video')) {
                $path = Storage::disk('public')->put('video-tweet', $request->video);
                $tweet->video = $path;
            }

            // Sauvegarder le tweet
            $tweet->save();

            return redirect()->route('myTweets');
        } catch (ValidationException $exception) {

            return redirect()->back()->withErrors($exception->errors())->withInput();
        }
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
