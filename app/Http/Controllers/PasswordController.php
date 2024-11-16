<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

   public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
    ]);

    // Update the user's password
    $user = $request->user();
    $user->password = Hash::make($request->password);
    $user->save();

    // Redirect to the profile edit route with success message
    return redirect()->route('profile.edit', ['user' => $user])->with('success', 'Password updated successfully.');
}
}
