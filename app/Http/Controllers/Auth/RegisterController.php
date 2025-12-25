<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',

            'password'  => 'required|min:8|confirmed',
        ], [

            'name.required'     => 'Nama lengkap wajib diisi.',
            'name.max'          => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email ini sudah terdaftar, silakan login.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validasi = $validator->validasi();

        User::create([
            'name'     => $validasi['name'],
            'email'    => $validasi['email'],
            'password' => Hash::make($validasi['password']),
            'role'     => 'user',
        ]);

        return redirect('/auth/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
