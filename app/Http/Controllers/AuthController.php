<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Check Email & Password
        if (Auth::attempt($request->only('email', 'password'))) {

            // Create New Session
            $request->session()->regenerate();

            // Redirect After Login
            return redirect()->route('tasks.index');
        }

        // If Login Failed
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Save User In Database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,

            // Encrypt Password
            'password' => Hash::make($request->password),
        ]);

        // Auto Login After Register
        Auth::login($user);

        return redirect()->route('tasks.index');
    }

    // Logout User
    public function logout(Request $request)
    {
        // Logout
        Auth::logout();

        // Destroy Session
        $request->session()->invalidate();

        // Generate New CSRF Token
        $request->session()->regenerateToken();

        // Redirect To Login Page
        return redirect()->route('login');
    }
}