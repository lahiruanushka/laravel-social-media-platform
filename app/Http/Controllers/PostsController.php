<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Retrieve IDs of users that the current user is following
        $followingIds = auth()->user()->following()->pluck('users.id');

        // Fetch posts from users that the current user is following, ordered by latest first
        $posts = Post::whereIn('user_id', $followingIds)
            ->with('user')
            ->latest() // Order by created_at DESC (latest first)
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        // Validate form data
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'image'], // Ensure 'image' is required and must be an image
        ]);

        // Handle image upload and storage
        if ($request->hasFile('image')) {
            // Generate a unique name for the image
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

            // Define the upload path
            $uploadPath = public_path('uploads/posts/');

            // Check if the directory exists, if not, create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Move the uploaded image to the upload path
            $request->file('image')->move($uploadPath, $name_gen);

            // Define the path to save in the database
            $imagePath = 'uploads/posts/' . $name_gen;
        }

        // Save post to the database
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        // Redirect to user's profile after creating the post
        return redirect('/profile/' . auth()->user()->id);
    }
    
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
