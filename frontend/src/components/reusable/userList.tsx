// 'use client';

// import { useEffect, useState } from 'react';



// export default function UserList({ onSelect }: { onSelect: (user: USER) => void }) {
//   const [users, setUsers] = useState<USER[]>([]);

//   useEffect(() => {
//     async function fetchUsers() {
//       const res = await fetch('http://localhost/api/users');
//       const data = await res.json();
//       setUsers(data);
//     }

//     fetchUsers();
//   }, []);

//   return (
//     <div className="border-r p-4 overflow-auto">
//       <h2 className="text-xl font-bold mb-4">Utilisateurs</h2>
//       <ul className="space-y-2">
//         {users.map((user) => (
//           <li
//             key={user.id}
//             className="cursor-pointer p-2 rounded hover:bg-gray-100 hover:text-black transition"
//             onClick={() => onSelect(user)}
//           >
//             {user.prenom} {user.nom}
//           </li>
//         ))}
//       </ul>
//     </div>
//   );
// }
'use client';

import { useEffect, useState } from 'react';

interface USER {
  id: number;
  nom: string;
  prenom: string;
}

export default function UserList({ onSelect }: { onSelect: (user: USER) => void }) {
  const [users, setUsers] = useState<USER[]>([]);
  const [selectedUserId, setSelectedUserId] = useState<number | null>(null);

  useEffect(() => {
    async function fetchUsers() {
      const res = await fetch('http://localhost/api/users');
      const data = await res.json();
      setUsers(data);
    }

    fetchUsers();
  }, []);

  const handleClick = (user: USER) => {
    setSelectedUserId(user.id);
    onSelect(user);
  };

  return (
    <div className="border-r p-4 overflow-auto w-1/3 max-w-xs">
      <h2 className="text-xl font-bold mb-4">Utilisateurs</h2>
      <ul className="space-y-2">
        {users.map((user) => (
          <li
            key={user.id}
            onClick={() => handleClick(user)}
            className={`cursor-pointer p-2 rounded transition-all duration-300 ease-in-out
              ${
                user.id === selectedUserId
                  ? 'bg-violet-500 text-white shadow-lg translate-x-1'
                  : 'bg-gray-400 text-black hover:bg-gray-100'
              }
            `}
          >
            {user.prenom} {user.nom}
          </li>
        ))}
      </ul>
    </div>
  );
}
