<?php

use App\Http\Controllers\NovelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\NovelCategoryController;
use App\Http\Controllers\Admin\NovelController as AdminNovelController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Routes
Route::get('/novels', [NovelController::class, 'index'])->name('novels.index');
Route::get('/novels/{novel}', [NovelController::class, 'show'])->name('novels.show');
Route::get('/novels/{novel}/chapters/{chapter}', [NovelController::class, 'showChapter'])->name('novels.chapters.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/user/password', [ProfileController::class, 'updatePassword'])->name('user-password.update');

    // Library routes
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Pages Management
    Route::resource('pages', PageController::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Categories Management
    Route::get('/categories', [NovelCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [NovelCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [NovelCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [NovelCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [NovelCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [NovelCategoryController::class, 'destroy'])->name('categories.destroy');

    // Novels Management
    Route::get('/novels', [AdminNovelController::class, 'index'])->name('novels.index');
    Route::get('/novels/create', [AdminNovelController::class, 'create'])->name('novels.create');
    Route::post('/novels', [AdminNovelController::class, 'store'])->name('novels.store');
    Route::get('/novels/{novel}/edit', [AdminNovelController::class, 'edit'])->name('novels.edit');
    Route::put('/novels/{novel}', [AdminNovelController::class, 'update'])->name('novels.update');
    Route::delete('/novels/{novel}', [AdminNovelController::class, 'destroy'])->name('novels.destroy');

    // Chapters Management
    Route::get('/novels/{novel}/chapters', [ChapterController::class, 'index'])->name('novels.chapters.index');
    Route::get('/novels/{novel}/chapters/create', [ChapterController::class, 'create'])->name('novels.chapters.create');
    Route::post('/novels/{novel}/chapters', [ChapterController::class, 'store'])->name('novels.chapters.store');
    Route::get('/novels/{novel}/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('novels.chapters.edit');
    Route::put('/novels/{novel}/chapters/{chapter}', [ChapterController::class, 'update'])->name('novels.chapters.update');
    Route::delete('/novels/{novel}/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('novels.chapters.destroy');

    // Page Management
    Route::resource('pages', PageController::class);
});


// Pages Routes
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
