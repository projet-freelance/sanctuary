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

    public function download(Ticket $ticket)
    {
        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));
        return $pdf->download("ticket-{$ticket->ticket_code}.pdf");
    }
}