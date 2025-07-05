'use client'
import { BASE_URL } from '@/lib/constants';
import { Session } from 'next-auth';
import { useEffect, useState } from 'react';

export default function MercureSubscriber({ receiverId, session }: { receiverId: number, session: Session }) {
  const token = session.token;
  const [message, setMessage] = useState<string | null>(null);

  useEffect(() => {
    // let eventSource: EventSource | null = null;
    async function connect() {
      const res = await fetch('http://localhost/mercure/token', {
        headers: {
          Authorization: `Bearer ${token}`, // token d'auth Symfony
        },
      });

      if (!res.ok) {
        console.error('Failed to fetch Mercure token', await res.text());
        return;
      }

      const { mercure_token } = await res.json();
      console.log("mercureToken: ", mercure_token);

      // const url = new URL('http://localhost:8001/.well-known/mercure');
      // url.searchParams.append('topic', '/books/1');
      // url.searchParams.append('token', mercure_token);

      // eventSource = new EventSource(url.toString());

      // eventSource.onmessage = (event) => {
      //   const data = JSON.parse(event.data);
      //   console.log('Message reçu via Mercure:', data);
      //   setMessage(data.status);
      // };

      // eventSource.onerror = (error) => {
      //   console.error('Erreur EventSource:', error);
      //   eventSource?.close();
      // };
    }

    connect();

    // return () => {
    //   eventSource?.close();
    // };
  }, [token]);

  return (
    <div className="p-4 border rounded bg-gray-50">
      <h2 className="text-lg font-bold mb-2">Abonné à /books/1</h2>
      {message ? (
        <p className="text-green-600">Message reçu : {message}</p>
      ) : (
        <p className="text-gray-500">En attente de message...</p>
      )}
    </div>
  );
}
