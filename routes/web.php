<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BibleVideoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\RadioController;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Gate;
use Aimeos\Shop\Base\Support;
use App\Http\Controllers\SiteStatsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OraisonSpirituelController;
use App\Http\Controllers\PickAngeController;

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

Route::get('/about', function () {
    return view('about');
});

Route::get('/site-stats', [SiteStatsController::class, 'index'])->name('site-stats');

Route::get('/bible_videos', [BibleVideoController::class, 'index'])->name('biblevideos.index');
Route::get('/bible_videos/{id}', [BibleVideoController::class, 'show'])->name('biblevideos.show');



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

Route::get('/testimonies', [TestimonyController::class, 'index'])->name('testimonies.index');

// Afficher le formulaire de création d'un témoignage
Route::get('/testimonies/create', [TestimonyController::class, 'create'])->name('testimonies.create');


Route::middleware(['auth'])->group(function () {
    // Afficher le profil de l'utilisateur
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    
    
    // Modifier le profil de l'utilisateur
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    
    // Supprimer le profil de l'utilisateur
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('prayers', PrayerController::class);
Route::get('/prayers', [PrayerController::class, 'index'])->name('prayers.index');
Route::post('/prayers', [PrayerController::class, 'store'])->name('prayer.store');
// Afficher la prière spécifique
Route::get('/prayers/{prayer}', [PrayerController::class, 'show'])->name('prayers.show');

// Afficher le formulaire de création
Route::get('/prayers/create', [PrayerController::class, 'create'])->name('prayers.create');



Route::post('/prayer/sms', [PrayerController::class, 'receiveSms'])->name('prayers.receiveSms');
Route::post('/prayer/audio', [PrayerController::class, 'receiveAudio'])->name('prayers.receiveAudio');

Route::get('/meditate', [QuoteController::class, 'randomQuote'])->name('quote.random');

Route::resource('teachings', TeachingController::class);

// Intégration du fichier auth pour les routes d'authentification

//radio
Route::get('/radios', [RadioController::class, 'index'])->name('radios.index');

Route::get('/chat', function () {
    return view('chat.index');
})->middleware(['auth'])->name('chat.index');
;

Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

Route::get('/payment/cancel', [ConsultationController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('/payment/success', [ConsultationController::class, 'paymentSuccess'])->name('payment.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
});

Route::middleware('auth')->get('/consultations/{id}', [ConsultationController::class, 'show'])->name('consultations.show');

// Routes publiques
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Routes protégées
Route::middleware(['auth'])->group(function () {
    // Paiement et tickets
    Route::post('/events/{event}/purchase', [EventController::class, 'purchase'])->name('events.purchase');
    Route::get('/events/{event}/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Tickets
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/download', [TicketController::class, 'download'])->name('tickets.download');
    Route::get('/tickets/{ticket}/pdf', [TicketController::class, 'generatePdf'])->name('tickets.pdf');
    Route::get('/ticket/{ticket}/generatePdf', [TicketController::class, 'generatePdf']);
});

Route::get('/products', function () {
    return view('products');
});


Route::middleware('auth')->group(function () {
    Route::get('/products', [OrderController::class, 'index'])->name('products.index');
   
    Route::post('/payments/{order}', [OrderController::class, 'makePayment'])->name('payments.make');
});
Route::get('/products', [OrderController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [OrderController::class, 'show'])->name('products.show');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/confirm/{id}', [OrderController::class, 'confirm'])->name('orders.confirm');


Route::middleware(['auth'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});


// Route pour Oraison Spirituel
Route::get('/oraison-spirituel', [OraisonSpirituelController::class, 'index'])->name('oraison-spirituel');
    
// Route pour Pick-Ange
Route::get('/pick-ange', [PickAngeController::class, 'index'])->name('pick-ange');

require __DIR__.'/auth.php';
