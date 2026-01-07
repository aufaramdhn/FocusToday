<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        session(['auth_source' => 'login']);

        return Socialite::driver('google')->redirect();
    }

    public function connect()
    {
        session(['auth_source' => 'profile']);

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $userByEmail = User::where('email', $googleUser->getEmail())->first();

            $currentUser = Auth::user();

            if (!Auth::check() && $userByEmail) {
                Auth::login($userByEmail);
                $currentUser = $userByEmail;
            }

            if ($currentUser) {

                $existingUser = User::where('google_id', $googleUser->getId())->first();

                if ($existingUser && $existingUser->id !== $currentUser->id) {
                    return redirect()->route('profile.social-media.index')
                        ->with('error', 'Akun Google ini milik user lain!');
                }

                $currentUser->update([
                    'google_id' => $googleUser->getId()
                ]);


                $source = session('auth_source');
                session()->forget('auth_source');

                if ($source === 'profile') {
                    return redirect()->route('profile.social-media.index')
                        ->with('success', 'Akun berhasil terhubung!');
                }

                if ($currentUser->hasVerifiedEmail()) {
                    return redirect()->route('home')
                        ->with('success', 'Login melalui Google berhasil!');
                }

                return redirect()->route('profile.index')
                    ->with('success', 'Login berhasil! Silakan verifikasi email Anda.');
            }

            if ($userByEmail) {
                $userByEmail->update(['google_id' => $googleUser->getId()]);
                $user = $userByEmail;
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'user'
                ]);
                event(new Registered($user));
            }

            Auth::login($user);

            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')
                    ->with('success', 'Akun berhasil dibuat! Silakan cek email untuk verifikasi.');
            }
            return redirect('/profile')->with('success', 'Login Berhasil melalui Google!');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $user = Auth::user();

        $user->update(['google_id' => null]);

        return back()->with('success', 'Akun Google berhasil diputuskan.');
    }
}
