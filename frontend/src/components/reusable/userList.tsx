'use client';

import { useEffect, useState } from 'react';



export default function UserList({ onSelect }: { onSelect: (user: USER) => void }) {
  const [users, setUsers] = useState<USER[]>([]);

  useEffect(() => {
    async function fetchUsers() {
      const res = await fetch('http://localhost/api/users');
      const data = await res.json();
      setUsers(data);
    }

    fetchUsers();
  }, []);

  return (
    <div className="border-r p-4 overflow-auto">
      <h2 className="text-xl font-bold mb-4">Utilisateurs</h2>
      <ul className="space-y-2">
        {users.map((user) => (
          <li
            key={user.id}
            className="cursor-pointer p-2 rounded hover:bg-gray-100 hover:text-black transition"
            onClick={() => onSelect(user)}
          >
            {user.prenom} {user.nom}
          </li>
        ))}
      </ul>
    </div>
  );
}