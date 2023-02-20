<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('home.index', [
            'tweets' => $tweets,
        ]);
    }
    public function search(Request $request)
    {
    $query = $request->input('query');
   
    $tweets = Tweet::where('text', 'like', '%'.$query.'%')->get();
    $users = User::where('name', 'like', '%'.$query.'%')->get();
   

    return view('search.results', compact('tweets', 'users', 'query'));
    }

}
