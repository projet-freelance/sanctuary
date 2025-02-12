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
            'birthdate' => 'nullable|date',
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'] ?? 'Non spécifié', // Valeur par défaut
            'country' => $validatedData['country'] ?? 'Non spécifié', // Valeur par défaut
            'city' => $validatedData['city'] ?? 'Inconnue', // Valeur par défaut
            'birthdate' => $validatedData['birthdate'] ?? null, // Valeur par défaut
            'status' => 1, // Par défaut 1 (actif)
            'role' => 'editor', // Par défaut 'editor'
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
