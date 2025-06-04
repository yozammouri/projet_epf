import { auth } from '@/auth'
import SignoutButton from '@/components/reusable/signoutButton'
import Link from 'next/link'
import { redirect } from 'next/navigation'
import React from 'react'

export default async function page() {
  const session = await auth()
  
  return (
            <>
              {session?.user.roles.includes("ROLE_APPRENANT") ? (
                <div className='flex justify-center items-center h-screen'>
                    <h1 className='font-bold'>APPRENANT PAGE CONTENT HERE</h1>
                </div>
                ) : 
                <div className='flex justify-center items-center h-screen font-bold'><span color='red'>Access only for APPRENANT!</span></div>
              }
            </>

            
)
}
