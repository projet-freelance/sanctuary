<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paydunya\Checkout\CheckoutInvoice;
use App\Models\Event;
use App\Models\Ticket;


class PaymentController extends Controller
{
    public function pay(Request $request, Event $event)
    {
        $invoice = new CheckoutInvoice();
        $invoice->addItem($event->name, 1, $event->ticket_price, $event->ticket_price);
        $invoice->setTotalAmount($event->ticket_price);
        $invoice->setDescription("Ticket for {$event->name}");
        $invoice->setReturnUrl(route('payment.success'));
        $invoice->setCancelUrl(route('payment.cancel'));

        if ($invoice->create()) {
            return redirect($invoice->getInvoiceUrl());
        } else {
            return back()->withErrors(['msg' => 'Payment initiation failed']);
        }
    }

    public function success(Request $request)
    {
        $invoice = new CheckoutInvoice();
        if ($invoice->confirm($request->token)) {
            $event = Event::find($invoice->getCustomData('event_id'));
            $user = auth()->user();

            $ticket = new Ticket();
            $ticket->event_id = $event->id;
            $ticket->user_id = $user->id;
            $ticket->ticket_code = uniqid();
            $ticket->save();

            return redirect()->route('tickets.show', $ticket);
        } else {
            return redirect()->route('payment.cancel');
        }
    }

    public function cancel()
    {
        return redirect()->route('events.index')->withErrors(['msg' => 'Payment cancelled']);
    }
}