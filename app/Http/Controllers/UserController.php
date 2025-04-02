<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'user' => auth()->user(),
            'reviews' => auth()->user()->reviews()->latest()->paginate(10)
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($user->logo_path) {
                Storage::delete($user->logo_path);
            }

            $image = $request->file('logo');
            $filename = Str::slug($user->name).'-'.time().'.'.$image->getClientOriginalExtension();
            
            // Resize and save logo
            $path = 'public/logos/'.$filename;
            $resizedImage = Image::make($image)->fit(200, 200)->encode();
            Storage::put($path, $resizedImage);

            $validated['logo_path'] = $path;
        }

        // Generate username if not set
        if (!$user->username) {
            $validated['username'] = $this->generateUniqueUsername($validated['business_name']);
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    protected function generateUniqueUsername($businessName)
    {
        $baseUsername = Str::slug($businessName);
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '-' . $counter;
            $counter++;
        }

        return $username;
    }
}