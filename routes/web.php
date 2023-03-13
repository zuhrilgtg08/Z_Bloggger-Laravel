<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'search'])->name('home.search');
Route::get('/home/post/detail/{posts:slug}', [HomeController::class, 'detail']);

Route::get('/about', function () {
    return view('pages.users.about', [
        "name" => "Ahmad Zuhril",
        "email" => "zuhrilfahrizal87@gmail.com",
    ]);
});

Route::get('/blog', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('pages.users.categories', [
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [LandingDashboardController::class, 'index'])->middleware('auth');

Route::name('dashboard.')->prefix('dashboard')->middleware(['auth:web'])->group(function() {
    // function route helper
    Route::get('/posts/checkSlug', [DashboardPostsController::class, 'checkSlug'])->name('posts.checkSlug');

    // resource route
    Route::resource('posts', DashboardPostsController::class)->middleware('auth');
    Route::resource('categories', AdminCategoryController::class)->middleware('admin');
});
