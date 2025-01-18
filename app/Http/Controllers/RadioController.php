<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radio;

class RadioController extends Controller
{
    
public function index()
{
    $radios = Radio::all();
    return view('radios.index', compact('radios'));
}
}
