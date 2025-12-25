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

Route::get('/register', function () {
    return view('auth.register');  
});

Route::get('/kategori', function () {
    return view('pages.detail-kategori');
});
 