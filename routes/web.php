<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;

// ─── Public Routes ───────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// API Routes for Live Search
Route::get('/api/search', [SearchController::class, 'apiSearch'])->name('api.search');
Route::post('/api/search/increment', [SearchController::class, 'apiIncrement'])->name('api.search.increment');

// ─── Admin Auth Routes (no middleware) ───────────────────────────────────────
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');
});

// ─── Admin Protected Routes ───────────────────────────────────────────────────
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('destinations', AdminDestinationController::class)->except(['show']);
    Route::resource('posts', AdminPostController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Pages / Static Content
    Route::get('pages/{page}/edit',    [PageController::class, 'edit'])->name('pages.edit');
    Route::post('pages/{page}/update', [PageController::class, 'update'])->name('pages.update');

    // Profile & Password
    Route::get('profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile',          [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
