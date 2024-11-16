<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $users = User::where('username', 'LIKE', "%{$query}%")
                        ->orWhere('name', 'LIKE', "%{$query}%")
                        ->with('profile')
                        ->paginate(15);

            $posts = Post::where('caption', 'LIKE', "%{$query}%")
                        ->with(['user', 'user.profile'])
                        ->latest()
                        ->paginate(15);
        } else {
            $users = collect([]);
            $posts = collect([]);
        }

        return view('search.index', compact('users', 'posts', 'query'));
    }
}
