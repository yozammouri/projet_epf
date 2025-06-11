import { auth } from '@/auth';
import Navbar from '@/components/reusable/navbar'
import React from 'react'

export default async function page() {
  const session = await auth();
  if(!session?.user)
  return (
    <>  
        <Navbar />
        <div className='flex justify-center items-center h-screen'>
            <h1 className='font-bold'>HOME PAGE CONTENT HERE</h1>
        </div>
    </>
  )
}
