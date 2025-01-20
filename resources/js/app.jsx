import './bootstrap';
import Alpine from 'alpinejs';
import React from 'react';
import { createRoot } from 'react-dom/client';
import ChatApp from './components/ChatApp';

// Initialisation d'Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialisation de React seulement si l'élément existe
document.addEventListener('DOMContentLoaded', () => {
    const chatRoot = document.getElementById('chat-root');
    if (chatRoot) {
        const root = createRoot(chatRoot);
        root.render(
            <React.StrictMode>
                <ChatApp />
            </React.StrictMode>
        );
    } else {
        console.error('Erreur : l\'élément chat-root est introuvable.');
    }
});
