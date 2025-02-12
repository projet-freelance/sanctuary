<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Affiche la liste des événements à venir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newEvents = Event::where('date_time', '>=', now())
            ->orderBy('date_time', 'asc')
            ->paginate(6);

        return view('events.index', compact('newEvents'));
    }

    /**
     * Affiche les détails d'un événement.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
    }

    /**
     * Traite l'achat d'un ticket pour un événement.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchase(Request $request, Event $event)
    {
        // Vérifiez si des places sont encore disponibles
        if ($event->available_seats < 1) {
            return redirect()->back()->with('error', 'Désolé, cet événement est complet.');
        }

        // Rediriger vers le PaymentController pour le paiement d'un seul ticket
        return redirect()->action([PaymentController::class, 'pay'], ['event' => $event->id]);
    }
}
