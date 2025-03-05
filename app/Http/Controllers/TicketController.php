<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function generatePdf(Ticket $ticket)
    {
        // Utiliser DomPDF pour générer le PDF à partir de la vue 'tickets.pdf'
        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));

        // Télécharger le PDF
        return $pdf->download("ticket-{$ticket->ticket_code}.pdf");
    }
}