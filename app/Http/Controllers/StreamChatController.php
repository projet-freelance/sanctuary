<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GetStream\StreamChat\Client;

class StreamChatController extends Controller
{
    public function getToken(Request $request)
    {
        $user = auth()->user(); // Vérifie si l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }

        try {
            // Initialiser le client Stream avec les clés API
            $client = new Client(
                env('STREAM_API_KEY'),
                env('STREAM_API_SECRET')
            );

            // Données utilisateur
            $userData = [
                'id' => (string) $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];

            // Générer le token pour l'utilisateur
            $token = $client->createToken((string) $user->id);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'token' => $token,
                    'user' => $userData,
                    'apiKey' => env('STREAM_API_KEY'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création du token',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
