<?php
namespace App\Http\Controllers;

use App\Models\Quote;

class QuoteController extends Controller
{
    public function randomQuote()
    {
        $quote = Quote::inRandomOrder()->first();
        return view('quote.random', compact('quote'));
    }
}
