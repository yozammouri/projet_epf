'use client';

import { Session } from 'next-auth';
import { useEffect, useState } from 'react';
import { EventSourcePolyfill } from 'event-source-polyfill';

export default function ChatBox({ receiverId, session }: { receiverId: number; session: Session }) {
  const token = session.token;
  const [messages, setMessages] = useState<string[]>([]);

  useEffect(() => {
    let eventSource: EventSourcePolyfill;

    async function initMercureSubscription() {
      try {
        // 1. Get Mercure JWT token from Symfony backend
        const res = await fetch('http://localhost/mercure/token', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (!res.ok) {
          console.error('Erreur récupération token Mercure: ', await res.text());
          return;
        }

        const data = await res.json();
        const mercureToken = data.mercure_token;

        // 2. Subscribe to topic using EventSourcePolyfill
        const topic = '/books/1'; // Must match Symfony `Update` topic
        const url = new URL('http://localhost:8001/.well-known/mercure');
        url.searchParams.append('topic', topic);

        console.log("mercure_token :",mercureToken)
        eventSource = new EventSourcePolyfill(url.toString(), {
          headers: {
            Authorization: `Bearer ${mercureToken}`,
          },
        });

        eventSource.onmessage = (event) => {
          console.log('Received message:', event.data);
          setMessages((prev) => [...prev, event.data]);
        };

        eventSource.onerror = (error) => {
          console.error('Mercure error:', error);
        };
      } catch (error) {
        console.error('Erreur setup Mercure:', error);
      }
    }

    initMercureSubscription();

    return () => {
      if (eventSource) eventSource.close();
    };
  }, [token]);

  return (
    <div className="p-4 mt-[100px] w-full h-[90vh] flex flex-col border rounded">
      <h2 className="text-lg font-bold">Mercure Messages (topic: /books/1)</h2>
      <ul className="mt-2 space-y-1">
        {messages.map((msg, i) => (
          <li key={i} className="p-2 rounded">
            {msg}
          </li>
        ))}
      </ul>
    </div>
  );
}
