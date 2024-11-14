<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggleLike(Request $request, Post $post)
    {
        // Log the request for debugging
        Log::info('Like request received', [
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'request_method' => $request->method(),
            'request_path' => $request->path(),
            'request_headers' => $request->headers->all()
        ]);

        try {
            $user = auth()->user();
            $existing_like = $post->likes()->where('user_id', $user->id)->first();

            if ($existing_like) {
                $existing_like->delete();
                $liked = false;
            } else {
                $post->likes()->create([
                    'user_id' => $user->id
                ]);
                $liked = true;
            }

            return response()->json([
                'status' => 'success',
                'liked' => $liked,
                'likes_count' => $post->likes()->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in toggle like', [
                'error' => $e->getMessage(),
                'post_id' => $post->id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }
}
