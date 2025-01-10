<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

// Page Versets (accessible uniquement aux utilisateurs connectés)
Route::get('/versets', function () {
    return view('versets');
})->middleware(['auth'])->name('versets');

// Page Prières (accessible uniquement aux utilisateurs connectés)
Route::get('/prieres', function () {
    return view('prieres');
})->middleware(['auth'])->name('prieres');

// Page Témoignages (accessible uniquement aux utilisateurs connectés)
Route::get('/temoignages', function () {
    return view('temoignages');
})->middleware(['auth'])->name('temoignages');

// Page Boutique (accessible uniquement aux utilisateurs connectés)
Route::get('/boutique', function () {
    return view('boutique');
})->middleware(['auth'])->name('boutique');

// Page à propos (accessible pour tous)
Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/bible', [BibleController::class, 'index'])->name('bible.index');
Route::get('/bible/chapter', [BibleController::class, 'showChapter'])->name('bible.chapter');
Route::get('/bible/show', [BibleController::class, 'showChapter'])->name('bible.show');

Route::resource('prayers', PrayerController::class)->middleware('auth');

Route::resource('testimonies', TestimonyController::class)->middleware('auth');

Route::resource('products', ProductController::class);

require __DIR__.'/auth.php';
