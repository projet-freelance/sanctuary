<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Affiche la liste des événements à venir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer les événements à venir (date_time >= maintenant) triés par date
        $newEvents = Event::where('date_time', '>=', now())
            ->orderBy('date_time', 'asc') // Tri par date ascendante
            ->paginate(6); // Pagination avec 6 événements par page

        // Retourner la vue `events.index` avec les événements récupérés
        return view('events.index', compact('newEvents'));
    }

    /**
     * Affiche les détails d'un événement.
     *
     * @param Event $event
     * @return \Illuminate\View\View
     */
    public function show($id)
{
    $event = Event::findOrFail($id); // 🔍 Forcer la récupération de l'événement
    
    return view('events.show', compact('event'));
}


    /**
     * Traite l'achat de tickets pour un événement.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchase(Request $request, Event $event)
{
    $request->validate([
        'quantity' => 'required|integer|min:1|max:10',
    ]);

    // Vérifiez si suffisamment de tickets sont disponibles
    if ($event->available_seats < $request->quantity) {
        return redirect()->back()->with('error', 'Désolé, il ne reste pas assez de tickets disponibles.');
    }

    // Redirigez vers le PaymentController pour le paiement
    return redirect()->action([PaymentController::class, 'pay'], ['event' => $event->id])->withInput();
}

}