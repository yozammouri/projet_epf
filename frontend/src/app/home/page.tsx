import { auth } from '@/auth'
import Navbar from '@/components/reusable/navbar'
import { redirect } from 'next/navigation';
import React from 'react'

export default async function page() {
  return (
    <>  
        <Navbar />
        <div className='flex justify-center items-center h-screen'>
            <h1 className='font-bold'>HOME PAGE CONTENT HERE</h1>
        </div>
    </>
  )
}
