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

    public function tweet()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('home.index', [
            'tweets' => $tweets,
        ]);
    }


    public function search(Request $request)
    {
    $search = $request->input('search');
   
    $tweets = Tweet::where('text', 'like', '%'.$search.'%')
                  ->orWhereHas('user', function ($query) use ($search) {
                      $query->where('name', 'like', '%'.$search.'%');
                  })
                  ->get();
    // dd($tweets);
    return view('home.index',['tweets' => $tweets]);
    }

}
