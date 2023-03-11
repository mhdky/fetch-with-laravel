<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/posts/search/{searchText}', [PostController::class, 'search']);

Route::get('/post', [PostController::class, 'index']);
Route::get('/post/data', [PostController::class, 'data']);

Route::get('/dashboard/post', [DashboardPostController::class, 'index']);
Route::post('/dashboard/post', [DashboardPostController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/dashboard', [DashboardController::class, 'store']);
Route::delete('/dashboard/{post:id}', [DashboardController::class, 'destroy']);
Route::get('/dashboard/{post:id}', [DashboardController::class, 'edit']);
Route::put('/dashboard/{post:id}', [DashboardController::class, 'update']);