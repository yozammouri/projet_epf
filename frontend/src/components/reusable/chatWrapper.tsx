'use client';

import { useState } from 'react';
import ChatBox from './chatBox'; // your real-time chat component
import UserList from './userList';

export default function ChatWrapper({ session, token }: { session: any, token: string }) {
  const [conversationId, setConversationId] = useState<number | null>(null);
  const [receiverId, setReceiverId] = useState<number | null>(null);

  const handleUserSelect = async (user: { id: number }) => {
    setReceiverId(user.id);

    const res = await fetch('http://localhost/api/conversations', {
      method: 'POST',
      headers: {
        // 'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ receiver_id: user.id,
        name: "RANDOM_NAME"
       }),
    });
    // console.log("receiver_id",receiverId)
    
    if(!res.ok) {
      const error = await res.text()
      console.log("error :", error)
    }
    const responseData = await res.json();
    console.log(responseData);
    const conversationId = responseData.conversation.id;
    console.log("conversation.id :",responseData.conversation.id);
    setConversationId(conversationId);
  };

  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className='flex justify-center items-center h-screen'>
        <h1 className='font-bold text-red-600'>You're not authorized to access this resource!</h1>
      </div>
    )
  }
  return (
    <div className="flex items-center w-full h-[100vh] ">
      <UserList onSelect={handleUserSelect} />
      {conversationId && receiverId && (
        <ChatBox conversationId={conversationId} receiverId={receiverId} session={session} />
      )}
    </div>
  );
}
