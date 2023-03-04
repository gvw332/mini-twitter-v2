<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Tweet;
use App\Models\Like;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'text' => 'required|max:1000',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:6000', // validate each image
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


    public function like($id, Request $request): RedirectResponse
    {
        try {
            // Récupérer l'utilisateur connecté
            $user = auth()->user();
            $user_id = $user->id;

            // Récupérer le tweet à liker
            $tweet = Tweet::findOrFail($id);

            // Vérifier si l'utilisateur n'est pas l'auteur du tweet
            if ($user->id === $tweet->user_id) {
                return redirect()->back()->withErrors(['error' => 'Vous ne pouvez pas liker votre propre tweet']);
            }

            // Vérifier si le "like" n'existe pas
            $existing_like = Like::where('user_id', $user_id)
                ->where('tweet_id', $id)
                ->first();

            // Si le "like" n'existe pas, le crée
            if (!$existing_like) {
                $like = new Like;
                $like->user_id = $user_id;
                $like->tweet_id = $id;
                $like->save();
                // Mettre à jour le nombre de likes dans le cache
                $cache_key = 'tweet_likes_' . $id;
                Cache::increment($cache_key);
            } else {
                $existing_like->delete();
                // Mettre à jour le nombre de likes dans le cache
                $cache_key = 'tweet_likes_' . $id;
                Cache::decrement($cache_key);
            }

            $page = $request->input('page');

            return redirect()->route('home', ['page' => $page]);
            
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->errors())->withInput();
        }
    }



    public function tweet($id)
    {
            // Récupérer le tweet à liker
            $tweet =  Tweet::with(['likes'])->withCount('likes')->findOrFail($id);
            
            $page = 1;           
            return view('viewbyid', [
                'tweet' => $tweet,
                'page' => $page,    
            ]);

    }

}
