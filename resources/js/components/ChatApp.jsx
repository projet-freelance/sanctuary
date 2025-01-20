import React, { useEffect, useState } from 'react';
import { StreamChat } from 'stream-chat';
import {
  Chat,
  Channel,
  ChannelList,
  Window,
  ChannelHeader,
  MessageList,
  MessageInput,
  Thread,
  LoadingIndicator
} from 'stream-chat-react';


const ChatApp = () => {
  const [client, setClient] = useState(null);
  const [activeChannel, setActiveChannel] = useState(null);

  useEffect(() => {
    const initChat = async () => {
      try {
        const response = await fetch('/api/chat/init');
        const data = await response.json();
        
        const chatClient = StreamChat.getInstance(data.api_key);
        await chatClient.connectUser(
          {
            id: data.user.id,
            name: data.user.name,
          },
          data.token
        );

        setClient(chatClient);
      } catch (error) {
        console.error('Erreur lors de l\'initialisation du chat:', error);
      }
    };

    initChat();
    return () => {
      if (client) client.disconnectUser();
    };
  }, []);

  const filters = { members: { $in: [client?.user?.id] } };
  const sort = { last_message_at: -1 };

  if (!client) {
    return (
      <div className="flex items-center justify-center min-h-screen">
        <LoadingIndicator />
      </div>
    );
  }

  return (
    <div className="h-screen w-full flex">
      <Chat client={client} theme="messaging light">
        <div className="w-1/4 border-r">
          <ChannelList
            filters={filters}
            sort={sort}
            onSelect={(channel) => setActiveChannel(channel)}
          />
        </div>
        <div className="w-3/4">
          {activeChannel ? (
            <Channel channel={activeChannel}>
              <Window>
                <ChannelHeader />
                <MessageList />
                <MessageInput />
              </Window>
              <Thread />
            </Channel>
          ) : (
            <div className="flex items-center justify-center h-full">
              <p>Sélectionnez un canal pour commencer à discuter</p>
            </div>
          )}
        </div>
      </Chat>
    </div>
  );
};

export default ChatApp;