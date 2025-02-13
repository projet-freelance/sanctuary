<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:32',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:200',
            'birthdate' => 'nullable|date|before:today', // Empêcher une date future
        ]);
    
        // Convertir birthdate au format 'YYYY-MM-DD'
        $birthdate = $validatedData['birthdate'] ? Carbon::parse($validatedData['birthdate'])->format('Y-m-d') : null;
    
        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'] ?? 'Non spécifié',
            'country' => $validatedData['country'] ?? 'Non spécifié',
            'city' => $validatedData['city'] ?? 'Inconnue',
            'birthdate' => $birthdate, // Date bien formatée
            'status' => 1,
            'role' => 'editor',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
