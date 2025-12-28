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
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\UserArticleController;
use App\Http\Controllers\Landing\ProfileController;
use App\Http\Controllers\Landing\DetailKategoriController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\OnboardingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/baca/{article:slug}', [HomeController::class, 'show'])->name('articles.show');

Route::get('/terbaru', [DetailKategoriController::class, 'terbaru'])->name('articles.latest');
Route::get('/kategori/{category:slug}', [DetailKategoriController::class, 'show'])->name('categories.show');

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

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.authenticate');

    Route::get('/auth/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::middleware(['auth', 'banned'])->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding');
    Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');
    Route::get('/onboarding/skip', [OnboardingController::class, 'skip'])->name('onboarding.skip');
});

Route::middleware(['auth', 'banned', 'admin'])->prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/tambah', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/tambah', [UserController::class, 'store'])->name('admin.user.store');
    Route::delete('/user/hapus/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/user/pdf-report', [UserController::class, 'pdfReporting'])->name('admin.user.pdf-report');
    Route::patch('/user/{user}/ban', [UserController::class, 'toggleBan'])->name('admin.user.ban');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/artikel', [ArticleController::class, 'index'])->name('admin.artikel.index');
    Route::get('/artikel/tambah', [ArticleController::class, 'create'])->name('admin.artikel.create');
    Route::post('/artikel/tambah', [ArticleController::class, 'store'])->name('admin.artikel.store');
    Route::get('/artikel/edit/{article}', [ArticleController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/artikel/edit/{article}', [ArticleController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/artikel/hapus/{article}', [ArticleController::class, 'destroy'])->name('admin.artikel.destroy');
    Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('admin.artikel.show');
    Route::patch('/artikel/{article}/archive', [ArticleController::class, 'archive'])->name('admin.artikel.archive');
    Route::patch('/artikel/{article}/restore', [ArticleController::class, 'restore'])->name('admin.artikel.restore');

    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/kategori/tambah', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/kategori/tambah', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/kategori/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/kategori/edit/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/kategori/hapus/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/tag', [TagController::class, 'index'])->name('admin.tag.index');
    Route::get('/tag/tambah', [TagController::class, 'create'])->name('admin.tag.create');
    Route::post('/tag/tambah', [TagController::class, 'store'])->name('admin.tag.store');
    Route::get('/tag/edit/{tag}', [TagController::class, 'edit'])->name('admin.tag.edit');
    Route::put('/tag/edit/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
    Route::delete('/tag/hapus/{tag}', [TagController::class, 'destroy'])->name('admin.tag.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('admin.comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});
