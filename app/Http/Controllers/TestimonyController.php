<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    // Afficher la liste des témoignages
    public function index()
    {
        $testimonies = Testimony::all();
        return view('testimonies.index', compact('testimonies'));
    }

    // Afficher le formulaire de création d'un témoignage
    public function create()
    {
        return view('testimonies.create');
    }

    // Sauvegarder un nouveau témoignage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
            'audio_path' => 'nullable|file|mimes:audio/mpeg,audio/wav|max:10240',
            
        ]);

        $testimony = new Testimony();
        $testimony->user_id = auth()->id();
        $testimony->title = $request->title;
        $testimony->content = $request->content;
        $testimony->type = $request->type;
        $testimony->audio_path = $request->file('audio_path') ? $request->file('audio_path')->store('audio') : null;
        $testimony->save();

        return redirect()->route('testimonies.index')->with('success', 'Témoignage créé avec succès.');
    }

    // Afficher un témoignage spécifique
    public function show($id)
    {
        $testimony = Testimony::findOrFail($id);
        return view('testimonies.show', compact('testimony'));
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $testimony = Testimony::findOrFail($id);
        return view('testimonies.edit', compact('testimony'));
    }

    // Mettre à jour un témoignage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
            'audio_path' => 'nullable|file|mimes:audio/mpeg,audio/wav|max:10240',
           
        ]);

        $testimony = Testimony::findOrFail($id);
        $testimony->title = $request->title;
        $testimony->content = $request->content;
        $testimony->type = $request->type;
        $testimony->audio_path = $request->file('audio_path') ? $request->file('audio_path')->store('audio') : $testimony->audio_path;
 
        $testimony->save();

        return redirect()->route('testimonies.index')->with('success', 'Témoignage mis à jour.');
    }

    // Supprimer un témoignage
    public function destroy($id)
    {
        $testimony = Testimony::findOrFail($id);
        $testimony->delete();
        return redirect()->route('testimonies.index')->with('success', 'Témoignage supprimé.');
    }
}
