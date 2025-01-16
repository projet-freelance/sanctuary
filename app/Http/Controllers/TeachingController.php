<?php

namespace App\Http\Controllers;

use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeachingController extends Controller
{
    public function create()
    {
        return view('teachings.create');
    }

    public function index()
{
    $teachings = Teaching::orderBy('created_at', 'desc')->get();
    return view('teachings.index', compact('teachings'));
}

public function show(Teaching $teaching)
{
    return view('teachings.show', compact('teaching'));
}



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:audio,video,text,link',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
            'video_file' => 'nullable|file|mimes:mp4,avi,mkv|max:10240',
            'text_content' => 'nullable|string',
            'url' => 'nullable|url',
            'is_live' => 'nullable|boolean',
            'live_start_at' => 'nullable|date',
        ]);

        // Création de l'enseignement
        $teaching = new Teaching();
        $teaching->title = $request->title;
        $teaching->description = $request->description;
        $teaching->type = $request->type;
        $teaching->url = $request->url;

        // Gérer les fichiers audio et vidéo
        if ($request->hasFile('audio_file')) {
            $teaching->url = $request->file('audio_file')->store('audio_files', 'public');
        }

        if ($request->hasFile('video_file')) {
            $teaching->url = $request->file('video_file')->store('video_files', 'public');
        }

        // Gérer le contenu texte
        if ($request->type === 'text') {
            $teaching->description = $request->text_content;
        }

        // Gérer les liens d'événements
        if ($request->type === 'link') {
            $teaching->partner_link = $request->url;
        }

        // Gérer le live
        $teaching->is_live = $request->has('is_live') ? 1 : 0;
        $teaching->live_start_at = $request->live_start_at;

        $teaching->save();

        return redirect()->route('teachings.index')->with('success', 'Enseignement ajouté avec succès!');
    }
}


