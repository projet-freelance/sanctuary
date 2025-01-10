<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use Illuminate\Http\Request;

class PrayerController extends Controller
{
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
        $validated = $request->validate([
            'intention' => 'required|string|max:255',
            'audio_path' => 'nullable|file|mimes:mp3,wav',
            'status' => 'required|string|in:en cours,exaucée,en attente',
            'category' => 'required|string|max:255',
            'privacy_level' => 'required|string|in:public,privé,communauté',
            'prayer_type' => 'required|string|in:intercession,gratitude,demande',
        ]);

        $validated['user_id'] = auth()->id(); // Associe à l'utilisateur connecté
        if ($request->hasFile('audio_path')) {
            $validated['audio_path'] = $request->file('audio_path')->store('prayers');
        }

        Prayer::create($validated);

        return redirect()->route('prayers.index')->with('success', 'Prière ajoutée avec succès.');
    }

    // Supprime une prière
    public function destroy(Prayer $prayer)
    {
        $prayer->delete();
        return redirect()->route('prayers.index')->with('success', 'Prière supprimée.');
    }
}
