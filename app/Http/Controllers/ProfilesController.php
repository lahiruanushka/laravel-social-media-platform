<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfilesController extends Controller
{
    use AuthorizesRequests;

    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile); // Use arrow (->) instead of hyphen (-)
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
{
    // Ensure the $user object exists
    if (!$user) {
        abort(404, 'User not found.');
    }

    // Authorization check
    $this->authorize('update', $user->profile);

    // Validate form data
    $data = request()->validate([
        'title' => 'required',
        'description' => 'required',
        'url' => 'url',
        'image' => 'image', // Ensure 'image' is an image file
    ]);

    // Handle image upload and storage
    if (request()->hasFile('profile-image')) {
        

            // Create an instance of ImageManager
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.request()->file('profile-image')->getClientOriginalExtension();

            // Store the image and resize it
            $image = $manager->read(request()->file('profile-image')); 
            //resized image
            $image = $image->resize(1000,1000);
            // save modified image in new format 
            $image->save(public_path('storage/uploads/profile-pictures/'.$name_gen));
            $imagePath = 'uploads/profile-pictures/'.$name_gen;

    } else {
        // If no new image uploaded, retain the existing image path
        $imagePath = $user->profile->image ?? null;
    }

    // Update the profile
    $user->profile->update(array_merge(
        $data,
        ['image' => $imagePath]
    ));

    // Redirect to user's profile after updating
    return redirect('/profile/' . $user->id);
}

}
