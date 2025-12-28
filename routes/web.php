<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Landing\UserArticleController;


Route::get('/', function () {
    return view('pages.home');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');

Route::get('/detail-kategori', function () {
    return view('pages.detail-kategori');
});

Route::get('/detail-artikel', function () {
    return view('pages.detail-artikel');
});

Route::get('/profile', function () {
    return view('pages.profile._profile');
})->name('profile.index');

Route::get('/profile/security', function () {
    return view('pages.profile._security');
})->name('profile.security');

Route::get('/profile/artikel', [UserArticleController::class, 'index'])->name('profile.artikel.index');
Route::get('/profile/artikel', [UserArticleController::class, 'index'])->name('profile.artikel.index');
Route::get('/profile/artikel/tambah', [UserArticleController::class, 'create'])->name('profile.artikel.create');
Route::post('/profile/artikel/tambah', [UserArticleController::class, 'store'])->name('profile.artikel.store');
Route::get('/profile/artikel/edit/{article}', [UserArticleController::class, 'edit'])->name('profile.artikel.edit');
Route::put('/profile/artikel/edit/{article}', [UserArticleController::class, 'update'])->name('profile.artikel.update');
Route::delete('/profile/artikel/hapus/{article}', [UserArticleController::class, 'destroy'])->name('profile.artikel.destroy');
Route::get('/profile/artikel/{article:slug}', [UserArticleController::class, 'show'])->name('profile.artikel.show');
Route::patch('/profile/artikel/{article}/archive', [UserArticleController::class, 'archive'])->name('profile.artikel.archive');
Route::patch('/profile/artikel/{article}/restore', [UserArticleController::class, 'restore'])->name('profile.artikel.restore');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
Route::get('/dashboard/artikel', [ArticleController::class, 'index'])->name('admin.artikel.index');
Route::get('/dashboard/artikel/tambah', [ArticleController::class, 'create'])->name('admin.artikel.create');
Route::post('/dashboard/artikel/tambah', [ArticleController::class, 'store'])->name('admin.artikel.store');
Route::get('/dashboard/artikel/edit/{article}', [ArticleController::class, 'edit'])->name('admin.artikel.edit');
Route::put('/dashboard/artikel/edit/{article}', [ArticleController::class, 'update'])->name('admin.artikel.update');
Route::delete('/dashboard/artikel/hapus/{article}', [ArticleController::class, 'destroy'])->name('admin.artikel.destroy');
Route::get('/dashboard/artikel/{article:slug}', [ArticleController::class, 'show'])->name('admin.artikel.show');
Route::patch('/dashboard/artikel/{article}/archive', [ArticleController::class, 'archive'])->name('admin.artikel.archive');
Route::patch('/dashboard/artikel/{article}/restore', [ArticleController::class, 'restore'])->name('admin.artikel.restore');

Route::post('/comments', [CommentController::class, 'store'])->name('admin.comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');

Route::get('/dashboard/kategori', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/dashboard/kategori/tambah', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/dashboard/kategori/tambah', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/dashboard/kategori/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/dashboard/kategori/edit/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/dashboard/kategori/hapus/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

Route::get('/dashboard/tag', [TagController::class, 'index'])->name('admin.tag.index');
Route::get('/dashboard/tag/tambah', [TagController::class, 'create'])->name('admin.tag.create');
Route::post('/dashboard/tag/tambah', [TagController::class, 'store'])->name('admin.tag.store');
Route::get('/dashboard/tag/edit/{tag}', [TagController::class, 'edit'])->name('admin.tag.edit');
Route::put('/dashboard/tag/edit/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
Route::delete('/dashboard/tag/hapus/{tag}', [TagController::class, 'destroy'])->name('admin.tag.destroy');

Route::get('/dashboard/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/dashboard/user/tambah', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/dashboard/user/tambah', [UserController::class, 'store'])->name('admin.user.store');
Route::delete('/dashboard/user/hapus/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/dashboard/user/pdf-report', [UserController::class, 'pdfReporting'])->name('admin.user.pdf-report');

Route::get('/auth/google', [RegisterController::class, 'google_redirect'])->name('auth.google');
Route::get('/auth/google/callback', [RegisterController::class, 'google_callback']);
