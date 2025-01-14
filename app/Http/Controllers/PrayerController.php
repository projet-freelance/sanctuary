<?php
namespace App\Http\Controllers;

use App\Models\Prayer;
use Illuminate\Http\Request;
use App\Models\PrayerIntention;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;
use App\Notifications\PrayerIntentionReceived;
use Notification;

class PrayerController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        // Configuration alternative avec désactivation SSL pour dev uniquement
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        
        $this->twilio = new Client($sid, $token);
        
        // Désactive la vérification SSL - UNIQUEMENT POUR LE DÉVELOPPEMENT
        $this->twilio->setHttpClient(new \Twilio\Http\CurlClient([
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0
        ]));
    }

    // Affiche la liste des prières
    public function index()
    {
        $prayers = Prayer::with('user')->get();
        return view('prayers.index', compact('prayers'));
    }

    // Affiche le détail d'une prière
    public function show(Prayer $prayer)
    {
        return view('prayers.show', compact('prayer'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('prayers.create');
    }

    // Enregistre une nouvelle prière
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg'
        ]);

        // Crée une nouvelle prière
        $prayer = Prayer::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        if ($request->hasFile('audio')) {
            // Ajoute l'audio si fourni
            $prayer->addMedia($request->file('audio'))->toMediaCollection('audio');
        }

        try {
            // Notifier les administrateurs de la nouvelle intention de prière
            $message = $this->twilio->messages->create(
                'admin_phone_number', // Remplacez par le vrai numéro
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => "Nouvelle intention de prière : " . $prayer->message
                ]
            );
        } catch (\Exception $e) {
            // Log l'erreur mais continue l'exécution
            \Log::error('Erreur Twilio: ' . $e->getMessage());
        }

        return redirect()->route('prayers.index')->with('success', 'Prière ajoutée avec succès.');
    }

    // Supprime une prière
    public function destroy(Prayer $prayer)
    {
        $prayer->delete();
        return redirect()->route('prayers.index')->with('success', 'Prière supprimée.');
    }

    // Méthode pour recevoir une intention de prière par SMS
    public function receiveSms(Request $request)
    {
        $message = $request->input('Body');
        $from = $request->input('From');

        // Sauvegarder l'intention de prière dans la base de données
        PrayerIntention::create([
            'user_id' => auth()->id(),
            'message' => $message
        ]);

        // Envoyer une réponse à l'utilisateur par SMS
        $response = new MessagingResponse();
        $response->message("Votre intention de prière a été reçue. Que Dieu vous bénisse.");
        return response()->xml($response);
    }
}