<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});

Route::get('/dashboard/artikel', function () {
    return view('admin.artikel.index');
});

Route::get('/dashboard/artikel/tambah', function () {
    return view('admin.artikel.tambah-artikel');
});

Route::get('/dashboard/artikel/edit', function () {
    return view('admin.artikel.edit-artikel');
});

Route::get('/dashboard/kategori', function () {
    return view('admin.kategori.index');
});

Route::get('/dashboard/kategori/tambah', function () {
    return view('admin.kategori.tambah-kategori');
});

Route::get('/dashboard/kategori/edit', function () {
    return view('admin.kategori.edit-kategori');
});

Route::get('/dashboard/user', function () {
    return view('admin.user.index');
});

Route::get('/dashboard/user/tambah', function () {
    return view('admin.user.tambah-pengguna');
});

Route::get('/register', function () {
    return view('auth.register');
    return view('admin.user.tambah-pengguna');
});

Route::get('/', function () {
    return view('auth.register');
});
