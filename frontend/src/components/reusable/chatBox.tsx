'use client';

import { useEffect, useState, useRef } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { EventSourcePolyfill } from 'event-source-polyfill';

interface Message {
  id: number;
  sender_id: number;
  content: string;
  createdAt: string;
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
  const {
    register,
    handleSubmit,
    reset,
    formState: { errors, isSubmitting },
  } = useForm<{ content: string }>({
    resolver: zodResolver(schema),
  });

  const bottomRef = useRef<HTMLDivElement | null>(null);

  // Scroll to bottom when messages change
  useEffect(() => {
    if (bottomRef.current) {
      bottomRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  }, [messages]);

  useEffect(() => {
    // Fetch existing messages
    async function fetchMessages() {
      const res = await fetch(`http://localhost/api/conversations/${conversationId}/messages`, {
        headers: { Authorization: `Bearer ${session.token}` },
      });
      if (res.ok) {
        const data: any[] = await res.json();
        const normalized = data.map((msg) => ({
          ...msg,
          createdAt: msg.created_at, // normalize key
        }));
        setMessages(normalized);
      } else {
        console.error('Failed to fetch messages');
      }
    }

    fetchMessages();

    // Subscribe to Mercure
    let eventSource: EventSourcePolyfill;

    async function subscribeMercure() {
      try {
        const tokenRes = await fetch('http://localhost/mercure/token', {
          headers: { Authorization: `Bearer ${session.token}` },
        });
        if (!tokenRes.ok) {
          console.error('Failed to get Mercure token');
          return;
        }
        const { mercure_token } = await tokenRes.json();

        const url = new URL('http://localhost:8001/.well-known/mercure');
        url.searchParams.append('topic', `/conversation/${conversationId}`);

        eventSource = new EventSourcePolyfill(url.toString(), {
          headers: { Authorization: `Bearer ${mercure_token}` },
        });

        eventSource.onmessage = (event) => {
          
          const message: Message = JSON.parse(event.data);
          setMessages((prev) => {
            const exists = prev.some((m) => m.id === message.id);
            return exists ? prev : [...prev, message];
            
          });
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
        console.error('Failed to send message:', await res.text());
      }
    } catch (error) {
      console.error('Error sending message', error);
    }
  }

  return (
    <div className="mt-[100px] flex flex-col w-2/3 h-[800px] p-4">
      <h2 className="text-xl font-bold mb-4">Conversation #{conversationId}</h2>

      {/* Message List */}
      <div className="flex-1 overflow-auto border rounded p-4 mb-4">
        {messages.length === 0 && <p className="text-gray-500">Aucun message</p>}
        <ul className="space-y-3 flex flex-col">
          {messages.map((msg) => {
            const isSender = msg.sender_id === session.user.id;
            return (
              <li
                key={msg.id}
                className={`p-2 rounded max-w-xs transition-all duration-300 ${
                  isSender ? 'bg-blue-500 text-white self-end' : 'bg-gray-200 text-gray-800 self-start'
                }`}
              >
                <p>{msg.content}</p>
                <span className="text-xs text-gray-600 block mt-1">
                  {new Date(msg.createdAt).toLocaleTimeString()}
                </span>
              </li>
            );
          })}
          <div ref={bottomRef} />
        </ul>
      </div>

      {/* Input box */}
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
