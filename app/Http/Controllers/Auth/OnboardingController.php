<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OnboardingController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->is_onboarded) {
            return redirect()->route('home');
        }

        return view('onboarding.setup');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'role' => 'required|in:editor,viewer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataToUpdate = [
            'role' => $request->role,
            'is_onboarded' => true,
        ];

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $dataToUpdate['avatar'] = $path;
        }

        $user->update($dataToUpdate);

        return redirect()->route('home')->with('success', 'Profil berhasil diatur! Selamat datang.');
    }
}
