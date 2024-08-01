<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = Auth::user();
        $user->date_of_birth = $user->date_of_birth ? Carbon::parse($user->date_of_birth) : null;
        return view('backend.pages.profile', compact('user'));
    }

    // Update the user profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'username' => 'nullable|string|max:255|unique:users,username,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;

        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Set a fixed name for the image
            $fixedName = 'profile_image.jpg';  // Fixed name for the image

            // Store the new image with the fixed name
            $imagePath = $request->file('image')->storeAs('profile_images', $fixedName, 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function showChangePasswordForm()
{
    return view('backend.pages.password');
}
public function updatePassword(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();

    // Check if the current password is correct
    if (!\Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Update the password
    $user->password = \Hash::make($request->new_password);
    $user->save();

    return redirect()->route('password.change')->with('success', 'Password updated successfully.');
}


}
