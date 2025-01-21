import React, { useEffect, useState } from 'react';
import { StreamChat } from 'stream-chat';
import {
    Chat,
    Channel,
    ChannelHeader,
    MessageList,
    MessageInput,
    LoadingIndicator
}
 from 'stream-chat-react';


const StreamChatComponent = () => {
    const [client, setClient] = useState(null);
    const [channel, setChannel] = useState(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        let chatClient = null;

        const initializeChat = async () => {
            try {
                const response = await fetch('/api/stream-chat/token');
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération du token');
                }
                const data = await response.json();

                // Initialiser le client avec la clé API
                chatClient = StreamChat.getInstance(data.apiKey);

                // Vérifier si l'utilisateur est déjà connecté
                if (chatClient.userID !== data.user.id) {
                    await chatClient.disconnectUser();
                    await chatClient.connectUser(data.user, data.token);
                }

                // Créer ou rejoindre le canal
                const newChannel = chatClient.channel('messaging', 'general', {
                    name: 'General Chat',
                    members: [data.user.id]
                });

                await newChannel.watch();
                
                setClient(chatClient);
                setChannel(newChannel);
                setError(null);
            } catch (err) {
                setError(`Erreur de connexion au chat: ${err.message}`);
                console.error('Erreur lors de la connexion au chat:', err);
            }
        };

        initializeChat();

        // Cleanup function
        return () => {
            if (chatClient) {
                chatClient.disconnectUser().then(() => {
                    console.log('Utilisateur déconnecté');
                });
            }
        };
    }, []); // Suppression de la dépendance client

    if (error) {
        return (
            <div className="p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <p>{error}</p>
            </div>
        );
    }

    if (!client || !channel) {
        return <LoadingIndicator />;
    }

    return (
        <div className="h-[600px]">
            <Chat client={client} theme="messaging light">
                <Channel channel={channel}>
                    <div className="str-chat__container">
                        <ChannelHeader />
                        <MessageList />
                        <MessageInput />
                    </div>
                </Channel>
            </Chat>
        </div>
    );
};

export default StreamChatComponent;