'use client'
import React from 'react'
import { Button } from '../ui/button'
import { deleteApprenant } from '@/lib/api/apprenantApi'
import { toast } from 'sonner';


export default function dialogDeleteAction({ apprenant, token }: { apprenant: Apprenant, token: string }) {
  return (
    <form action={
        async () => {
            try{
                await deleteApprenant(apprenant.id_apprenant, token)
                toast.success(`Apprenant deleted successfully!`);
            }catch (err) {
                            console.error(err);
                            toast.error("Something wrong happened With Deleting this Apprenant!");
                        }
        }
    }>
        
        <Button
            variant="destructive"
            className='hover:cursor-pointer'
            type="submit"                
        >
        Delete
        </Button>
    </form>
  )
}