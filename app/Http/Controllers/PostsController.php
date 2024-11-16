<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Retrieve posts from users that the current user is following
        $followingIds = auth()->user()->following()->pluck('users.id');
        $posts = Post::whereIn('user_id', $followingIds)
            ->with('user')
            ->latest()
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

    // Add the edit method
    public function edit(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized');
        }

        return view('posts.edit', compact('post'));
    }

    // Add the update method
    public function update(Request $request, Post $post)
    {
        // Validate form data
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['nullable', 'image'], // Image is optional for update
        ]);

        // Handle image upload if a new image is uploaded
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

            // Delete the old image if a new one is uploaded
            if (File::exists(public_path($post->image))) {
                File::delete(public_path($post->image));
            }

            // Update the post with the new image path
            $post->image = $imagePath;
        }

        // Update the caption
        $post->caption = $data['caption'];

        // Save the changes
        $post->save();

        // Redirect to the post page
        return redirect()->route('posts.show', $post);
    }

    // Add the destroy method
    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized');
        }

        // Delete the post's image from storage
        if (File::exists(public_path($post->image))) {
            File::delete(public_path($post->image));
        }

        // Delete the post from the database
        $post->delete();

        // Redirect to the user's profile
        return redirect('/profile/' . auth()->user()->id)->with('success', 'Post deleted successfully');
    }
}
