<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->image) {
            return redirect()->route('home');
        }

        return view('auth.onboarding');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('avatars', 'public');

            $user->update([
                'image' => $path
            ]);
        }

        return redirect()->route('home')->with('success', 'Profil Anda sudah siap!');
    }

    public function skip()
    {
        return redirect()->route('home');
    }
}
