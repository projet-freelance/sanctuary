<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Affiche les détails d'un événement.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupère l'événement ou renvoie une erreur 404 si non trouvé
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Traite l'achat de tickets pour un événement.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchase(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10', // Limite à 10 tickets par achat
        ]);

        // Récupère l'événement ou renvoie une erreur 404 si non trouvé
        $event = Event::findOrFail($id);

        // Vérifie si suffisamment de tickets sont disponibles
        if ($event->available_tickets < $request->quantity) {
            return redirect()->back()->with('error', 'Désolé, il ne reste pas assez de tickets disponibles.');
        }

        // Démarre une transaction pour garantir l'intégrité des données
        DB::beginTransaction();
        try {
            // Met à jour le nombre de tickets disponibles
            $event->available_tickets -= $request->quantity;
            $event->save();

            // Ici, vous pouvez ajouter la logique pour enregistrer l'achat dans la table `tickets`
            // Exemple :
            // $ticket = new Ticket();
            // $ticket->event_id = $event->id;
            // $ticket->user_id = auth()->id(); // Si l'utilisateur est connecté
            // $ticket->quantity = $request->quantity;
            // $ticket->save();

            // Valide la transaction
            DB::commit();

            // Redirige avec un message de succès
            return redirect()->route('events.show', $id)->with('success', 'Votre ticket a été acheté avec succès !');
        } catch (\Exception $e) {
            // Annule la transaction en cas d'erreur
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'achat. Veuillez réessayer.');
        }
    }
}