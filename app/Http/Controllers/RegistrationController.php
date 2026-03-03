<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration; // This links to your Database Model

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validation (Make sure data is actually there)
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'category' => 'required|string',
        ]);

        // 2. Create the User in the Database
        $user = Registration::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'category' => $request->category,
            'state' => $request->state, // Add this
            'city' => $request->city,   // Add this
        ]);

        // 3. Send a "Receipt" back to Flutter
        return response()->json([
            'message' => 'Registration Successful!',
            'user' => $user
        ], 201); // 201 means "Created"
    }

    public function login(Request $request)
    {
        $user = Registration::where('mobile', $request->mobile)->first();

        if ($user) {
            return response()->json(['message' => 'Login Success', 'user' => $user], 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}