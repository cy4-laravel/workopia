<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // @desc update profile info
    // @route PUT / profile
    public function update(Request $request): RedirectResponse {
        // get logged in user
        $user = Auth::user();

        // validate data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email'
        ]);
        // update user info
        $user->update($validatedData);
        return redirect()->route('dashboard')->with('success', 'Profile info updated');
    }
}
