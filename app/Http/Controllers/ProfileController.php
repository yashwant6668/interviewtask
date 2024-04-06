<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function uploadProfileImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the uploaded file
        $image = $request->file('profile_image');

        // Generate a unique name for the file
        $imageName = Auth::id().'_profile_image_'.time().'.'.$image->getClientOriginalExtension();

        // Move the file to the public/images/profile directory
        $image->storeAs('public/images/profile', $imageName);

        // Update the user's profile image filename in the database
        Auth::user()->update(['profile_image' => $imageName]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile image uploaded successfully.');
    }
}
