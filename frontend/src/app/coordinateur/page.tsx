// "use client"

import React from 'react'
import { auth} from '@/auth'
import { redirect } from 'next/navigation'
import SignoutButton from '@/components/reusable/signoutButton'

export default async function page() {
      const session = await auth()
      console.log("This is the stored token : ",session?.token)
  return (
    <div className="w-screen bg-white">
      <div className="h-screen">
        {session?.user ? (
          <>
            <div className='w-screen flex justify-between items-center px-8 py-4 bg-white shadow-sm'>
              <div>
                <h1 className='text-bold'>Welcome Back <span className='font-bold'>Mr. {session.user.nom} {session.user.prenom}</span></h1>  
                <div className='text-xs'>{session.user.username}</div>
              </div>
              <div> <SignoutButton /></div> 
              
            </div>
          </>
        ) : ( 
              redirect("/home")
            )}
      </div>
    </div>

  )
}
