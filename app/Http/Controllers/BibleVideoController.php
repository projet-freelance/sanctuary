<?php

namespace App\Http\Controllers;

use App\Models\BibleVideo;
use Illuminate\Http\Request;

class BibleVideoController extends Controller
{
    // Afficher toutes les vidéos
    public function index()
    {
        $videos = BibleVideo::all();
        return view('biblevideos.index', compact('videos'));
    }

    // Afficher une vidéo spécifique
    public function show($id)
    {
        $video = BibleVideo::findOrFail($id);
        return view('biblevideos.show', compact('video'));
    }
}
