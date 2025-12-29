<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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
            // Gunakan stateless agar session tidak crash
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek User berdasarkan Email
            $userByEmail = User::where('email', $googleUser->getEmail())->first();

            // Cek User yang sedang login (Session)
            $currentUser = Auth::user();

            if (!Auth::check() && $userByEmail) {
                Auth::login($userByEmail);
                $currentUser = $userByEmail;
            }

            if ($currentUser) {

                $existingUser = User::where('google_id', $googleUser->getId())->first();
                
                // Cek Validasi Kepemilikan Akun
                if ($existingUser && $existingUser->id !== $currentUser->id) {
                    return redirect()->route('profile.social-media.index')
                        ->with('error', 'Akun Google ini milik user lain!');
                }

                // Update Data
                $currentUser->update([
                    'google_id' => $googleUser->getId()
                ]);

                // --- LOGIKA DINAMIS (THE FIX) ---
                
                // Cek jejak: Dari mana user berasal?
                $source = session('auth_source'); 
                
                // Hapus jejak biar bersih
                session()->forget('auth_source');

                // Jika asalnya dari 'profile', balikin ke profile. Selain itu ke home.
                if ($source === 'profile') {
                    return redirect()->route('profile.social-media.index')
                        ->with('success', 'Akun berhasil terhubung!');
                }

                // Default (Login biasa)
                return redirect()->route('home')
                    ->with('success', 'Login Berhasil!');
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
            }

            Auth::login($user);
            return redirect('/');
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
