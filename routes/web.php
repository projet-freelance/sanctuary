<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use APP\Http\Controllers\PrayerIntentionController;
use App\Http\Controllers\BibleVideoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\RadioController;

use Illuminate\Support\Facades\Gate;
use Aimeos\Shop\Base\Support;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});


Route::get('/bible_videos', [BibleVideoController::class, 'index'])->name('biblevideos.index');
Route::get('/bible_videos/{id}', [BibleVideoController::class, 'show'])->name('biblevideos.show');


Route::get('/produit', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('aimeos_home');

// Route Dashboard client (accessible uniquement pour les utilisateurs connectés)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboardclient', [DashboardController::class, 'index'])->name('dashboard');
});

// Route admin d'Aimeos protégée par un rôle

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

// Routes pour la Bible
Route::get('/bible', [BibleController::class, 'index'])->name('bible.index');
Route::get('/bible/chapter', [BibleController::class, 'showChapter'])->name('bible.chapter');
Route::get('/bible/show', [BibleController::class, 'showChapter'])->name('bible.show');

// Routes pour les prières et témoignages (accessible uniquement aux utilisateurs connectés)
Route::resource('prayers', PrayerController::class)->middleware('auth');
Route::resource('testimonies', TestimonyController::class)->middleware('auth');



// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile/me', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/me', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/me', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('prayers', PrayerController::class);
Route::post('/prayers', [PrayerController::class, 'store'])->name('prayer.store');

Route::get('/prayerintention', [PrayerIntentionController::class, 'create'])->name('prayer_intentions.create');
Route::post('/prayerintention', [PrayerController::class, 'store'])->name('prayer.store');
Route::post('/twilio/receive', [PrayerIntentionController::class, 'receiveSms']);



Route::post('/prayer/sms', [PrayerController::class, 'receiveSms'])->name('prayers.receiveSms');
Route::post('/prayer/audio', [PrayerController::class, 'receiveAudio'])->name('prayers.receiveAudio');

Route::get('/meditate', [QuoteController::class, 'randomQuote'])->name('quote.random');

Route::resource('teachings', TeachingController::class);

// Intégration du fichier auth pour les routes d'authentification

//radio
Route::get('/radios', [RadioController::class, 'index'])->name('radios.index');
require __DIR__.'/auth.php';
