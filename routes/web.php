<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/liked', [HomeController::class, 'liked'])->name('liked');
Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::post('/thoughts', [ThoughtController::class, 'store'])->name('thoughts.store');
Route::get('/thoughts/{thought}/edit', [ThoughtController::class, 'edit'])->name('thoughts.edit');
Route::put('/thoughts/{thought}', [ThoughtController::class, 'update'])->name('thoughts.update');
Route::delete('/thoughts/{thought}', [ThoughtController::class, 'destroy'])->name('thoughts.destroy');
Route::post('/thoughts/{thought}/like', [ThoughtController::class, 'like'])->name('thoughts.like');
Route::post('/thoughts/{thought}/dislike', [ThoughtController::class, 'dislike'])->name('thoughts.dislike');





