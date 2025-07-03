// 'use client';

// import { Session } from 'next-auth';
// import { useEffect, useState } from 'react';
// import { EventSourcePolyfill } from 'event-source-polyfill';

// export default function ChatBox({ receiverId, session }: { receiverId: number; session: Session }) {
//   const token = session.token;
//   const [messages, setMessages] = useState<string[]>([]);

//   useEffect(() => {
//     let eventSource: EventSourcePolyfill;

//     async function initMercureSubscription() {
//       try {
//         // 1. Get Mercure JWT token from Symfony backend
//         const res = await fetch('http://localhost/mercure/token', {
//           headers: {
//             Authorization: `Bearer ${token}`,
//           },
//         });

//         if (!res.ok) {
//           console.error('Erreur récupération token Mercure: ', await res.text());
//           return;
//         }

//         const data = await res.json();
//         const mercureToken = data.mercure_token;

//         // 2. Subscribe to topic using EventSourcePolyfill
//         const topic = '/books/1'; // Must match Symfony `Update` topic
//         const url = new URL('http://localhost:8001/.well-known/mercure');
//         url.searchParams.append('topic', topic);

//         console.log("mercure_token :",mercureToken)
//         eventSource = new EventSourcePolyfill(url.toString(), {
//           headers: {
//             Authorization: `Bearer ${mercureToken}`,
//           },
//         });

//         eventSource.onmessage = (event) => {
//           console.log('Received message:', event.data);
//           setMessages((prev) => [...prev, event.data]);
//         };

//         eventSource.onerror = (error) => {
//           console.error('Mercure error:', error);
//         };
//       } catch (error) {
//         console.error('Erreur setup Mercure:', error);
//       }
//     }

//     initMercureSubscription();

//     return () => {
//       if (eventSource) eventSource.close();
//     };
//   }, [token]);

//   return (
//     <div className="p-4 mt-[100px] w-full h-[90vh] flex flex-col border rounded">
//       <h2 className="text-lg font-bold">Mercure Messages (topic: /books/1)</h2>
//       <ul className="mt-2 space-y-1">
//         {messages.map((msg, i) => (
//           <li key={i} className="p-2 rounded">
//             {msg}
//           </li>
//         ))}
//       </ul>
//     </div>
//   );
// }
'use client';

import { useEffect, useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { EventSourcePolyfill } from 'event-source-polyfill';

interface Message {
  id: number;
  sender_id: number;
  content: string;
  created_at: string;
}

const schema = z.object({
  content: z.string().min(1, 'Le message ne peut pas être vide'),
});

interface ChatBoxProps {
  conversationId: number;
  receiverId: number;
  session: { token: string; user: { id: number } };
}

export default function ChatBox({ conversationId, receiverId, session }: ChatBoxProps) {
  const [messages, setMessages] = useState<Message[]>([]);
  const { register, handleSubmit, reset, formState: { errors, isSubmitting } } = useForm<{ content: string }>({
    resolver: zodResolver(schema),
  });

  useEffect(() => {
    // Fetch existing messages
    async function fetchMessages() {
      const res = await fetch(`http://localhost/api/conversations/${conversationId}/messages`, {
        headers: { Authorization: `Bearer ${session.token}` },
      });
      if (res.ok) {
        const data: Message[] = await res.json();
        setMessages(data);
      } else {
        console.error('Failed to fetch messages');
      }
    }

    fetchMessages();

    // Subscribe to Mercure for real-time updates
    let eventSource: EventSourcePolyfill;

    async function subscribeMercure() {
      try {
        // Get Mercure token from backend
        const tokenRes = await fetch('http://localhost/mercure/token', {
          headers: { Authorization: `Bearer ${session.token}` },
        });
        if (!tokenRes.ok) {
          console.error('Failed to get Mercure token');
          return;
        }
        const { mercure_token } = await tokenRes.json();
        // console.log("mercure_token :",mercure_token)

        const url = new URL('http://localhost:8001/.well-known/mercure');
        url.searchParams.append('topic', `/conversation/${conversationId}`);

        eventSource = new EventSourcePolyfill(url.toString(), {
          headers: { Authorization: `Bearer ${mercure_token}` },
        });

        eventSource.onmessage = (event) => {
          const message: Message = JSON.parse(event.data);
          setMessages((prev) => [...prev, message]);
        };

        eventSource.onerror = (error) => {
          console.error('Mercure connection error', error);
          eventSource.close();
        };
      } catch (error) {
        console.error('Error subscribing to Mercure:', error);
      }
    }

    subscribeMercure();

    return () => {
      if (eventSource) eventSource.close();
    };
  }, [conversationId, session.token]);

  // Send message handler
  async function onSubmit(data: { content: string }) {
    try {
      const res = await fetch('http://localhost/api/message', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${session.token}`,
        },
        body: JSON.stringify({
          conversation_id: conversationId,
          content: data.content,
        }),
      });

      if (res.ok) {
        reset();
      } else {
        console.error('Failed to send message :',res.text());
      }
    } catch (error) {
      console.error('Error sending message', error);
    }
  }

  return (
    <div className="mt-[200px] flex flex-col w-2/3 h-screen p-4">
      <h2 className="text-xl font-bold mb-4">Conversation #{conversationId}</h2>
      <div className="flex-1 overflow-auto border rounded p-4 mb-4 bg-white">
        {messages.length === 0 && <p className="text-gray-500">Aucun message</p>}
        <ul className="space-y-3">
          {messages.map((msg) => {
            const isSender = msg.sender_id === session.user.id;
            return (
              <li
                key={msg.id}
                className={`p-2 rounded max-w-xs ${isSender ? 'bg-blue-500 text-white self-end' : 'bg-gray-200 text-gray-800 self-start'}`}
              >
                <p>{msg.content}</p>
                <span className="text-xs text-gray-600 block mt-1">{new Date(msg.created_at).toLocaleTimeString()}</span>
              </li>
            );
          })}
        </ul>
      </div>
      <form onSubmit={handleSubmit(onSubmit)} className="flex space-x-2">
        <input
          {...register('content')}
          placeholder="Écrire un message..."
          className="flex-grow border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400"
          disabled={isSubmitting}
        />
        <button
          type="submit"
          disabled={isSubmitting}
          className="bg-blue-600 text-white px-4 rounded disabled:opacity-50"
        >
          Envoyer
        </button>
      </form>
      {errors.content && <p className="text-red-600 mt-1">{errors.content.message}</p>}
    </div>
  );
}
