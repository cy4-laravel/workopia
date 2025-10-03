<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    // @desc show register form
    // @route GET /register
    public function register(): View {
        return view('auth.register');
    }
    
    // @desc Store user in database
    // @route POST /register
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // create user
        $user = User::create($validatedData);
        return redirect()->route('login')->with('success', 'You are registered and can log in!');
    }

}
