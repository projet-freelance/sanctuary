<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use Illuminate\Http\Request;
use App\Models\PrayerIntention;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;
use Notification;

class PrayerController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        
        $this->twilio = new Client($sid, $token);

        // Désactiver SSL pour le développement uniquement (commenté par défaut)
        /*
        $this->twilio->setHttpClient(new \Twilio\Http\CurlClient([
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0
        ]));
        */
    }

    /**
     * Affiche la liste des prières.
     */
    public function index()
    {
        $prayers = Prayer::with('user')->get();
        return view('prayers.index', compact('prayers'));
    }

    /**
     * Affiche le détail d'une prière.
     */
    public function show(Prayer $prayer)
    {
        return view('prayers.show', compact('prayer'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('prayers.create');
    }

    /**
     * Enregistre une nouvelle prière.
     */
    public function store(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg|max:10240' // Limite de taille de fichier 10MB
        ]);

        // Log de la requête reçue
        \Log::info('Store request data:', $request->all());

        try {
            // Création de la prière
            $prayer = Prayer::create([
                'user_id' => auth()->id(), // L'utilisateur connecté
                'title' => $request->title,
                'message' => $request->message,
            ]);

            // Vérification de l'upload de fichier audio
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                \Log::info('Audio file uploaded: ' . $audio->getClientOriginalName());

                // Enregistrement du fichier dans MediaLibrary
                $prayer->addMedia($audio)->toMediaCollection('audio');
            }

            \Log::info('Prayer created successfully: ', $prayer->toArray());

            return redirect()->route('prayers.index')->with('success', 'Prière ajoutée avec succès.');

        } catch (\Exception $e) {
            // Log l'exception pour le debugging
            \Log::error('Error creating prayer: ' . $e->getMessage());
            return redirect()->route('prayers.index')->with('error', 'Une erreur s\'est produite lors de l\'ajout de la prière.');
        }
    }

    /**
     * Supprime une prière.
     */
    public function destroy(Prayer $prayer)
    {
        try {
            $prayer->delete();
            return redirect()->route('prayers.index')->with('success', 'Prière supprimée.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
        }
    }

    /**
     * Reçoit une intention de prière par SMS.
     */
    public function receiveSms(Request $request)
    {
        $message = $request->input('Body');
        $from = $request->input('From');

        try {
            // Sauvegarde de l'intention
            PrayerIntention::create([
                'user_id' => auth()->id(),
                'message' => $message,
            ]);

            // Réponse SMS
            $response = new MessagingResponse();
            $response->message("Votre intention de prière a été reçue. Que Dieu vous bénisse.");

            return response($response, 200)->header('Content-Type', 'text/xml');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue : ' . $e->getMessage()], 500);
        }
    }
}
