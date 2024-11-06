<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ProfilesController extends Controller
{
    use AuthorizesRequests;

    public function index(User $user)
    {
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            fn() => $user->posts->count()
        );

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            fn() => $user->followers->count()
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            fn() => $user->following->count()
        );

        return view('profiles.index', compact('user', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Check if user exists and authorize update
        abort_unless($user, 404, 'User not found.');
        $this->authorize('update', $user->profile);

        // Validate form data
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'nullable|url',
            'image' => 'nullable|image',
        ]);

        // Handle image upload and storage
        if ($request->hasFile('image')) {
            $imageName = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $uploadPath = public_path('uploads/profile-pictures');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $request->file('image')->move($uploadPath, $imageName);
            $data['image'] = 'uploads/profile-pictures/' . $imageName;
        }

        // Update the profile
        $user->profile->update($data);

        // Redirect to user's profile after updating
        return redirect()->route('profile.show', ['user' => $user->id]);
    }
}
