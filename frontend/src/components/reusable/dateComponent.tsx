'use client';

import { useEffect, useState } from 'react';

export default function DateTimeDisplay() {
  const [date, setDate] = useState('');
  const [time, setTime] = useState('');
  const [dayName, setDayName] = useState('');

  useEffect(() => {
    const updateDateTime = () => {
      const now = new Date();

      const formattedDate = now.toISOString().slice(0, 10).replace(/-/g, '/');
      const formattedTime = now.toTimeString().slice(0, 8);

      const options = { weekday: 'long' } as const;
      const day = now.toLocaleDateString('fr-FR', options); // Ex: "jeudi"

      setDate(formattedDate);
      setTime(formattedTime);
      setDayName(day);
    };

    updateDateTime();
    const interval = setInterval(updateDateTime, 1000);
    return () => clearInterval(interval);
  }, []);

  return (
    <>
      <h1 className='font-bold text-2xl'>{date}</h1>
      <p className='font-bold text-xl'>{dayName}</p>
      <p className='font-bold text-md text-gray-500'>{time}</p>
    </>
  );
}


  

