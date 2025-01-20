<?php

namespace App\Services;

use GetStream\StreamChat\Client;

class StreamChatService
{
    protected $client;

    public function __construct()
    {
        // Instanciation du client Stream avec les clés API
        $this->client = new Client(
            env('STREAM_API_KEY'),
            env('STREAM_API_SECRET')
        );
    }

    // Méthode pour créer un token pour un utilisateur
    public function createToken($username)
    {
        return $this->client->createToken($username);
    }
}
