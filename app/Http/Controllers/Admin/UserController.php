<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->all())->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.tambah-user');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|confirmed|',
            'password_confirmation' => 'required|min:8|same:password',
            'role'      => 'required|in:admin,editor,user',
        ], [
            'email.unique' => 'Email ini sudah dipakai user lain.',
            'role.in'      => 'Pilihan role tidak valid.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        if (Auth::id() == $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri saat sedang login!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function pdfReporting(Request $request)
    {
        $users = User::filter($request->all())->get();
        return view('admin.user.pdf-reporting', compact('users'));
    }

    public function toggleBan(User $user)
    {
        if (Auth::id() == $user->id) {
            return back()->with('error', 'anda tidak bisa memblokir diri sendiri!');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Anda tidak bisa memblokir Admin lain!');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'diblokir' : 'diaktifkan kembali';
        return back()->with('success', "User berhasil $status.");
    }
}
