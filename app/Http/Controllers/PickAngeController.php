<?php
// Fichier: app/Http/Controllers/PickAngeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PickAngeController extends Controller
{
    /**
     * Affiche la page de Pick-Ange
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pick-ange');
    }
}