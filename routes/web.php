<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;


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

Route::get('/', [FrontendController::class, 'GetPost'])->name('GetPost');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/createPost', [HomeController::class, 'createPost'])->name('createPost');
Route::post('/like/post', [HomeController::class, 'Like'])->name('Like');
Route::post('/comments/post', [HomeController::class, 'comments'])->name('comments');