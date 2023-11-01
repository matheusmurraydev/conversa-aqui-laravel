<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfilePhotoController extends Controller
{

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file validation rules as needed
        ]);

        $user = Auth::user();

        // Delete the previous profile photo from S3
        if ($user->profile_photo_path) {
            
            Storage::disk('s3')->delete($user->profile_photo_path);
        }

        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('profile-photos', 's3');

            $photoUrl = Storage::disk('s3')->url($photoPath);

            $user->update(['profile_photo_path' => $photoUrl]);
        }

        return response()->json([
            'message' => 'Profile photo updated successfully',
            'photo_url' => $photoUrl,
        ]);
    }

    public function getProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            $photoUrl = Storage::disk('s3')->url($user->profile_photo_path);
            return response()->json(['photo_url' => $photoUrl]);
        } else {
            return response()->json(['message' => 'Profile photo not found'], 404);
        }
    }
}

