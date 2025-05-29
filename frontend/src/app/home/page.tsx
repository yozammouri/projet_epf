import { auth } from '@/auth'
import Navbar from '@/components/reusable/navbar'
import { redirect } from 'next/navigation';
import React from 'react'

export default async function page() {
  const session = await auth();
  if(session) redirect("/coordinateur") 
  return (
    <>  
        <Navbar />
        <div className='flex justify-center items-center h-screen'>
            <h1 className='font-bold'>HOME PAGE CONTEND HERE</h1>
        </div>
    </>
  )
}
