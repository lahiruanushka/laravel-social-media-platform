<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;  // Make sure to import the User model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $user = auth()->user();
      $usersNotFollowed = User::with('profile') // Eager load profiles
    ->whereNotIn('id', $user->following->pluck('id'))
    ->where('id', '!=', $user->id)
    ->get();


       $posts = Post::with('user')
    ->where(function ($query) use ($user) {
        $query->where('user_id', $user->id)
              ->orWhereIn('user_id', $user->following->pluck('id'));
    })
    ->orderBy('created_at', 'desc')
    ->get();

        // Return view with posts and users
        return view('home', compact('posts', 'usersNotFollowed'));
    }
}
