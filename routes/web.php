<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- CONTROLLERS ---

// 1. Auth & Setup
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;

// 2. Landing / Public
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Landing\VideoController;
use App\Http\Controllers\Admin\CategoryController;

// 3. Admin Dashboard
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\OnboardingController;
use App\Http\Controllers\Landing\ProfileController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Landing\UserArticleController;
use App\Http\Controllers\Landing\DetailArtikelController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Landing\DetailKategoriController;


/*
|--------------------------------------------------------------------------
| A. Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/baca/{article:slug}', [HomeController::class, 'show'])->name('articles.show');
Route::get('/terbaru', [DetailKategoriController::class, 'terbaru'])->name('articles.latest');
Route::get('/kategori/{category:slug}', [DetailKategoriController::class, 'show'])->name('categories.show');
Route::get('/detail-artikel', [DetailArtikelController::class, 'index'])->name('detail-artikel');
Route::get('/pencarian', [HomeController::class, 'search'])->name('home.search');
Route::get('/watch/{videoId}', [VideoController::class, 'show'])->name('video.show');

/*
|--------------------------------------------------------------------------
| B. Guest Routes (Hanya untuk yang BELUM Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login & Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.authenticate');

    // Google Auth
    Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

    // Password Reset
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');
});


/*
|--------------------------------------------------------------------------
| C. Authenticated Routes (Harus LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 1. Logout & Disconnect (Bisa diakses level user apapun)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::delete('/auth/google/disconnect', [GoogleController::class, 'disconnect'])->name('google.disconnect');
    Route::get('/auth/google/connect', [GoogleController::class, 'connect'])->name('google.connect');

    Route::get('/check-verification-status', function () {
        $isVerified = Auth::user()?->hasVerifiedEmail();
        $isOnboarded = Auth::user()?->is_onboarded;

        return response()->json([
            'verified' => $isVerified,
            'onboarded' => $isOnboarded
        ]);
    })->middleware('auth');

    // 2. Verifikasi Email (SATPAM LEVEL 1)
    // User yang belum verifikasi akan tertahan di sini
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::get('/email/verify', 'notice')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', 'send')->middleware(['throttle:6,1'])->name('verification.send');
    });


    // --- GROUP: SUDAH VERIFIKASI EMAIL ---
    Route::middleware(['verified'])->group(function () {

        // 3. Onboarding / Setup Profil (SATPAM LEVEL 2)
        // Middleware 'onboarded' di sini menjaga agar user yg SUDAH setup tidak bisa balik ke sini
        Route::controller(OnboardingController::class)->middleware(['onboarded'])->group(function () {
            Route::get('/onboarding', 'index')->name('onboarding.index');
            Route::post('/onboarding', 'store')->name('onboarding.store');
        });


        // --- GROUP: SUDAH ONBOARDING (FULL ACCESS) ---
        // Semua route di bawah ini hanya bisa diakses jika user punya Avatar & Role
        Route::middleware(['onboarded'])->group(function () {

            // ==========================================
            // AREA USER (Landing / Profile)
            // ==========================================

            // Komentar Artikel
            Route::controller(DetailArtikelController::class)->group(function () {
                Route::post('/detail-artikel/komentar', 'store')->name('artikel.comment.store');
                Route::put('/detail-artikel/komentar/{comment}', 'update')->name('artikel.comment.update');
                Route::delete('/detail-artikel/komentar/{comment}', 'destroy')->name('artikel.comment.destroy');
            });
            // Profile & Settings
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('/profile/security', [ProfileController::class, 'securityIndex'])->name('profile.security.index');
            Route::post('/profile/security/change-password', [ProfileController::class, 'changePassword'])->name('profile.security.change-password');
            Route::get('/profile/link-social-media', [ProfileController::class, 'socialMediaIndex'])->name('profile.social-media.index');
            Route::post('/profile/link-social-media/update', [ProfileController::class, 'updateSocialMedia'])->name('profile.social-media.update');
            Route::delete('/profile/avatar/delete', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.delete');

            Route::post('/profile/resend-verification', [ProfileController::class, 'resendVerificationProfile'])->middleware(['throttle:6,1'])->name('user.verification.send');

            // Manajemen Artikel User (Penulis)
            Route::prefix('profile/artikel')->name('profile.artikel.')->group(function () {
                Route::get('/', [UserArticleController::class, 'index'])->name('index');
                Route::get('/tambah', [UserArticleController::class, 'create'])->name('create');
                Route::post('/tambah', [UserArticleController::class, 'store'])->name('store');
                Route::get('/edit/{article}', [UserArticleController::class, 'edit'])->name('edit');
                Route::put('/edit/{article}', [UserArticleController::class, 'update'])->name('update');
                Route::delete('/hapus/{article}', [UserArticleController::class, 'destroy'])->name('destroy');
                Route::get('/{article:slug}', [UserArticleController::class, 'show'])->name('show');
                Route::patch('/{article}/archive', [UserArticleController::class, 'archive'])->name('archive');
                Route::patch('/{article}/restore', [UserArticleController::class, 'restore'])->name('restore');
            });


            // ==========================================
            // AREA ADMIN DASHBOARD
            // ==========================================
            // Middleware 'admin' dan 'banned' tetap dipasang
            Route::middleware(['banned', 'admin'])->prefix('dashboard')->name('admin.')->group(function () {

                Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

                // User Management
                Route::prefix('user')->name('user.')->group(function () {
                    Route::get('/', [UserController::class, 'index'])->name('index');
                    Route::get('/tambah', [UserController::class, 'create'])->name('create');
                    Route::post('/tambah', [UserController::class, 'store'])->name('store');
                    Route::delete('/hapus/{user}', [UserController::class, 'destroy'])->name('destroy');
                    Route::get('/pdf-report', [UserController::class, 'pdfReporting'])->name('pdf-report');
                    Route::patch('/{user}/ban', [UserController::class, 'toggleBan'])->name('ban');
                    Route::post('/{user}/resend-verification', [UserController::class, 'resendVerification'])->name('resend-verification');
                });

                // Article Management
                Route::prefix('artikel')->name('artikel.')->group(function () {
                    Route::get('/', [ArticleController::class, 'index'])->name('index');
                    Route::get('/tambah', [ArticleController::class, 'create'])->name('create');
                    Route::post('/tambah', [ArticleController::class, 'store'])->name('store');
                    Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('edit');
                    Route::put('/edit/{article}', [ArticleController::class, 'update'])->name('update');
                    Route::delete('/hapus/{article}', [ArticleController::class, 'destroy'])->name('destroy');
                    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
                    Route::patch('/{article}/archive', [ArticleController::class, 'archive'])->name('archive');
                    Route::patch('/{article}/restore', [ArticleController::class, 'restore'])->name('restore');
                });

                // Categories
                Route::prefix('kategori')->name('categories.')->group(function () {
                    Route::get('/', [CategoryController::class, 'index'])->name('index');
                    Route::get('/tambah', [CategoryController::class, 'create'])->name('create');
                    Route::post('/tambah', [CategoryController::class, 'store'])->name('store');
                    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
                    Route::put('/edit/{category}', [CategoryController::class, 'update'])->name('update');
                    Route::delete('/hapus/{category}', [CategoryController::class, 'destroy'])->name('destroy');
                });

                // Tags
                Route::prefix('tag')->name('tag.')->group(function () {
                    Route::get('/', [TagController::class, 'index'])->name('index');
                    Route::get('/tambah', [TagController::class, 'create'])->name('create');
                    Route::post('/tambah', [TagController::class, 'store'])->name('store');
                    Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('edit');
                    Route::put('/edit/{tag}', [TagController::class, 'update'])->name('update');
                    Route::delete('/hapus/{tag}', [TagController::class, 'destroy'])->name('destroy');
                });

                // Comments
                Route::prefix('comments')->name('comments.')->group(function () {
                    Route::post('/', [CommentController::class, 'store'])->name('store');
                    Route::put('/{comment}', [CommentController::class, 'update'])->name('update');
                    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
                });
            }); // End Group Admin

        }); // End Group Onboarded

    }); // End Group Verified

}); // End Group Auth