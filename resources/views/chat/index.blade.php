<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream Chat</title>
    
    <!-- CSS de Stream Chat -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/stream-chat-css/dist/css/index.min.css">
    <style>
        #chat-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        #chat-interface {
            display: flex;
            gap: 20px;
            height: 80vh;
        }

        #channel-list {
            width: 250px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }

        #chat-box {
            flex: 1;
            border: 1px solid #ccc;
            display: flex;
            flex-direction: column;
        }

        #messages {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background: #f5f5f5;
        }

        .message.own {
            background: #e3f2fd;
            margin-left: 20%;
        }

        .message-input-container {
            padding: 15px;
            border-top: 1px solid #ccc;
        }

        #message-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <h1>Stream Chat</h1>
        <div id="chat-interface">
            <div id="channel-list"></div>
            <div id="chat-box">
                <div id="messages"></div>
                <div class="message-input-container">
                    <input type="text" id="message-input" placeholder="Tapez votre message...">
                </div>
            </div>
        </div>
    </div>

    <!-- Importation de la dernière version de Stream Chat -->
    <script src="https://cdn.jsdelivr.net/npm/stream-chat"></script>

    <script>
        async function initializeChat() {
            try {
                // Création du client avec la nouvelle syntaxe
                const client = new StreamChat('gbz9mbd8rtpg');
                const userToken = '{{ $token }}';
                const userId = '{{ auth()->user()->name }}';
                const userName = '{{ auth()->user()->name }}';

                // Connexion de l'utilisateur
                await client.connectUser(
                    {
                        id: userId,
                        name: userName,
                    },
                    userToken
                );

                // Création d'un canal
                const channel = client.channel('messaging', 'general', {
                    name: 'General Chat',
                    members: [userId]
                });

                // Initialisation du canal
                await channel.watch();

                // Gestion des messages
                const messagesContainer = document.getElementById('messages');
                const messageInput = document.getElementById('message-input');

                // Affichage des messages existants
                const state = await channel.watch();
                state.messages.forEach(message => {
                    displayMessage(message, userId);
                });

                // Écoute des nouveaux messages
                channel.on('message.new', event => {
                    displayMessage(event.message, userId);
                });

                // Envoi de messages
                messageInput.addEventListener('keypress', async (event) => {
                    if (event.key === 'Enter' && messageInput.value.trim()) {
                        try {
                            await channel.sendMessage({
                                text: messageInput.value
                            });
                            messageInput.value = '';
                        } catch (error) {
                            console.error('Erreur d\'envoi:', error);
                        }
                    }
                });

                function displayMessage(message, currentUserId) {
                    const messageElement = document.createElement('div');
                    messageElement.className = `message ${message.user.id === currentUserId ? 'own' : ''}`;
                    messageElement.innerHTML = `
                        <strong>${message.user.name}</strong><br>
                        ${message.text}
                    `;
                    messagesContainer.appendChild(messageElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }

                console.log('Chat initialisé avec succès');
            } catch (error) {
                console.error('Erreur d\'initialisation:', error);
                document.getElementById('messages').innerHTML = 
                    `<div style="color: red;">Erreur d'initialisation: ${error.message}</div>`;
            }
        }

        // Initialisation au chargement de la page
        window.addEventListener('load', initializeChat);
    </script>
</body>
</html>