<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PopularPostsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AdminCategoryController;
use App\Http\Controllers\Dashboard\DashboardPostsController;
use App\Http\Controllers\Dashboard\LandingDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [LandingDashboardController::class, 'index'])->middleware('auth');

Route::name('dashboard.')->prefix('dashboard')->middleware(['auth:web'])->group(function () {
    // function route helper
    Route::get('/posts/checkSlug', [DashboardPostsController::class, 'checkSlug'])->name('posts.checkSlug');
    Route::get('/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->name('categories.checkSlug');
    Route::get('/account/setting/{users:id}', [LandingDashboardController::class, 'edit'])->name('account.setting');
    Route::put('/account/setting/{users:id}', [LandingDashboardController::class, 'update'])->name('account.update');
    Route::put('/account/setting/changes_password/{users:id}', [LandingDashboardController::class, 'updatePassword'])->name('account.change');

    // resource route
    Route::resource('posts', DashboardPostsController::class)->middleware('auth');
    Route::resource('categories', AdminCategoryController::class)->middleware('admin');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'search'])->name('home.search');
Route::get('/home/post/detail/{posts:slug}', [HomeController::class, 'detail'])->name('home.post.detail');
Route::post('/rating/comment', [HomeController::class, 'ratingComment'])->name('rating.comment')->middleware('auth');

Route::get('/about', function () {
    return view('pages.users.about');
});

Route::get('/popular', [PopularPostsController::class, 'index']);

Route::get('/categories', function () {
    return view('pages.users.categories', [
        'categories' => Category::all()
    ]);
});

