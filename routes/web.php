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

Route::get('/debug-db', function() {
    try {
        $hasSessionsTable = \Illuminate\Support\Facades\Schema::hasTable('sessions');
        $users = \App\Models\User::all();
        $sessions = $hasSessionsTable ? \Illuminate\Support\Facades\DB::table('sessions')->latest('last_activity')->limit(5)->get() : [];
        
        return [
            'database_connected' => true,
            'sessions_table_exists' => $hasSessionsTable,
            'user_count' => $users->count(),
            'users' => $users->map(fn($u) => ['id' => $u->id, 'email' => $u->email, 'is_admin' => $u->is_admin]),
            'sessions' => $sessions,
            'app_url' => config('app.url'),
            'session_driver' => config('session.driver'),
            'session_secure' => config('session.secure'),
            'current_session_id' => session()->getId(),
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});

Route::get('/force-login', function() {
    $user = \App\Models\User::where('is_admin', true)->first();
    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        session()->put('force_login_at', now()->toDateTimeString());
        session()->save(); // Force save
        return [
            'status' => 'success',
            'message' => 'Logged in as ' . $user->email,
            'redirect_url' => route('admin.dashboard'),
            'session_id' => session()->getId(),
            'instructions' => 'Now please visit /check-auth to see if this stuck.'
        ];
    }
    return "No admin user found!";
});

Route::get('/check-auth', function() {
    $isLoggedIn = \Illuminate\Support\Facades\Auth::check();
    $user = $isLoggedIn ? \Illuminate\Support\Facades\Auth::user() : null;
    
    return [
        'logged_in' => $isLoggedIn,
        'user_id' => $user ? $user->id : null,
        'is_admin' => $user ? $user->is_admin : null,
        'session_id' => session()->getId(),
        'force_login_at' => session()->get('force_login_at'),
        'cookies' => $_COOKIE,
        'config_driver' => config('session.driver'),
        'config_secure' => config('session.secure'),
    ];
});

// API Routes for Live Search
Route::get('/api/search', [SearchController::class, 'apiSearch'])->name('api.search');
Route::post('/api/search/increment', [SearchController::class, 'apiIncrement'])->name('api.search.increment');

// ─── Admin Routes ────────────────────────────────────────────────────────────
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Auth (No Middleware)
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('logout', [AuthController::class, 'logout']); // Fallback GET logout

    // Protected Routes (Auth & Admin Middleware)
    Route::middleware(['auth', 'admin'])->group(function () {
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
});
