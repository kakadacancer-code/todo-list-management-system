<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the user profile page.
     */
    public function index()
    {
        $user = Auth::user();

        $completedCount = $user->todos()->where('status', 'completed')->count();
        $pendingCount   = $user->todos()->where('status', 'pending')->count();
        $totalCount     = $completedCount + $pendingCount;
        $rate           = $totalCount > 0
            ? round(($completedCount / $totalCount) * 100)
            : 0;

        return view('profile.index', compact(
            'user',
            'completedCount',
            'pendingCount',
            'totalCount',
            'rate'
        ));
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'role'        => 'nullable|string|max:255',
            'about'       => 'nullable|string|max:1000',
            'employee_id' => 'nullable|string|max:100',
            'department'  => 'nullable|string|max:100',
            'status'      => 'nullable|string|max:100',
            'quote'       => 'nullable|string|max:255',
            'location'    => 'nullable|string|max:255',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password'    => 'nullable|string|min:8|confirmed',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Handle password change
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');    }
}