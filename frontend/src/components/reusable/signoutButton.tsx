import React from 'react'
import { signOut } from "@/auth"
import { Button } from '../ui/button'


export default function signoutButton() {
  return (
    <form
      action={async () => {
        "use server"
        await signOut()
      }}
    >
        <Button type="submit" className="text-white hover:underline"        /*onClick={() => signOut()}*/>
            Sign Out
        </Button>
    </form>
  )
}
