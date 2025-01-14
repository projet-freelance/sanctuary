<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrayerIntention;
use Twilio\TwiML\MessagingResponse;
use App\Notifications\PrayerIntentionReceived;
use Notification;



class PrayerIntentionController extends Controller
{   

    public function create()
    {
        return view('prayer_intentions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg'
        ]);

        $prayerIntention = PrayerIntention::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        if ($request->hasFile('audio')) {
            $prayerIntention->addMedia($request->file('audio'))->toMediaCollection('audio');
        }

        // Notifier les administrateurs
        Notification::route('twilio', 'admin_phone_number')
            ->notify(new PrayerIntentionReceived($prayerIntention));

        return redirect()->route('prayerintention.index');
    }

    public function receiveSms(Request $request)
    {
        $message = $request->input('Body');
        $from = $request->input('From');

        // Sauvegarder l'intention de prière dans la base de données
        PrayerIntention::create([
            'user_id' => auth()->id(),
            'message' => $message
        ]);

        // Envoyer une réponse à l'utilisateur
        $response = new MessagingResponse();
        $response->message("Votre intention de prière a été reçue. Que Dieu vous bénisse.");
        return response()->xml($response);
    }
}
