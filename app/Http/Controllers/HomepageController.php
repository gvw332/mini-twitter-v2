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
        
        $tweets = Tweet::with('user')
        ->withCount('likes')
        ->latest()
        ->paginate(10);
        $page = $tweets->currentPage();
        return view('home.index', [
            'tweets' => $tweets,
            'page' => $page,
        ]);
    }

    public function tweet()
    {
        
        $tweets = Tweet::with('user')
        ->withCount('likes')
        ->latest()
        ->paginate(10);
        
        $page = $tweets->currentPage();
        
        return view('home.index', [
            'tweets' => $tweets,
            'page' => $page,
        ]);
    }
    
    public function myTweets()
    {
        $tweets = Tweet::with('user')
                    ->withCount('likes')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
        $page = $tweets->currentPage();
        return view('home.index', [
            'tweets' => $tweets,
            'page' => $page,
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        $tweets = Tweet::where('text', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->withCount('likes')
            ->latest()->paginate(10);
        $notweets = false;

        if ($tweets->isEmpty()) {
            $tweets = Tweet::with('user')
            ->withCount('likes')
            ->latest()
            ->paginate(10);
            $notweets = true;
        }
        $page = $tweets->currentPage();
        return view('home.index', ['tweets' => $tweets, 'search' => $search, 'notweets' => $notweets,'page' => $page]);
    }


}


