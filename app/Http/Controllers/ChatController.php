<?php

namespace App\Http\Controllers;

use App\Services\StreamChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $streamChatService;

    public function __construct(StreamChatService $streamChatService)
    {
        $this->streamChatService = $streamChatService;
    }

    // Cette méthode est utilisée pour afficher l'interface du chat
    public function index()
    {
        // Créer un token pour l'utilisateur connecté
        $token = $this->streamChatService->createToken(auth()->user()->name);

        // Passer le token à la vue
        return view('chat.index', compact('token'));
    }
}
