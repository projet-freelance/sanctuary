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
        // Valider les données de la requête
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10', // Limite à 10 tickets par achat
        ]);

        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour acheter des tickets.');
        }

        // Vérifier si suffisamment de tickets sont disponibles
        if ($event->available_tickets < $request->quantity) {
            return redirect()->back()->with('error', 'Désolé, il ne reste pas assez de tickets disponibles.');
        }

        // Démarrer une transaction pour garantir l'intégrité des données
        DB::beginTransaction();
        try {
            // Mettre à jour le nombre de tickets disponibles
            $event->available_tickets -= $request->quantity;
            $event->save();

            // Enregistrer l'achat dans la table `tickets`
            $ticket = new Ticket([
                'event_id' => $event->id,
                'user_id' => auth()->id(), // ID de l'utilisateur connecté
                'quantity' => $request->quantity,
            ]);
            $ticket->save();

            // Valider la transaction
            DB::commit();

            // Rediriger avec un message de succès
            return redirect()->route('events.show', $event->id)->with('success', 'Votre ticket a été acheté avec succès !');
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();
            // Loguer l'erreur pour le débogage
            Log::error('Échec de l\'achat du ticket : ' . $e->getMessage());
            // Rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'achat. Veuillez réessayer.');
        }
    }
}