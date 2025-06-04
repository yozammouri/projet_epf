import React from 'react'
import { signOut } from "@/auth"
import { Button } from '../ui/button'
import { handleSignOut } from '@/actions/auth/login'


export default function signoutButton() {
  return (
    <form
      action={handleSignOut}
    >
        <Button type="submit" className="text-white hover:cursor-pointer"        /*onClick={() => signOut()}*/>
            Sign Out
        </Button>
    </form>
  )
}
