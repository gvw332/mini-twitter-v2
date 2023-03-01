<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;

class HomepageController extends Controller
{



    public function index()
    {
        
        $tweets = Tweet::with('user')->latest()->paginate(10);
        $page = $tweets->currentPage();
        return view('home.index', [
            'tweets' => $tweets,
            'page' => $page,
        ]);
    }

    public function tweet()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('home.index', [
            'tweets' => $tweets,
        ]);
    }
    
    public function myTweets()
    {
        $tweets = Tweet::with('user')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
    
        return view('home.index', [
            'tweets' => $tweets,
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        $tweets = Tweet::where('text', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()->paginate(10);
        $notweets = false;

        if ($tweets->isEmpty()) {
            $tweets = Tweet::with('user')->latest()->paginate(10);
            $notweets = true;
        }
        // Compter le nombre d'enregistrements correspondant à $id dans le fichier "like"
        $tweets = Tweet::all();
        $likeCounts = [];
            
        foreach ($tweets as $tweet) {
            $likeCounts[$tweet->id] = Like::where('tweet_id', $tweet->id)->count();
        }
        return view('home.index', ['tweets' => $tweets, 'search' => $search, 'notweets' => $notweets, 'likeCounts' => $likeCounts]);
    }


}


