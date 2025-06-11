'use server'

import { auth } from '@/auth';
import { BASE_URL } from '@/lib/constants';
import { revalidatePath} from 'next/cache';




export async function getApprenants(page: number, token : string) {
  const session = await auth()
  if(!session?.user.roles.includes("ROLE_COORDINATEUR")){console.log("You're not allowed to use this api")}
  const limit = 3;
  const res = await fetch(
    `${BASE_URL}/api/apprenant/all?page=${page}&limit=${limit}`,
    { 
      cache: 'no-store', 
      headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
    } // to always fetch fresh data on request
  );

  if (!res.ok) {
    throw new Error('Failed to fetch apprenants');
  }

  return res.json();
}


export async function getApprenantById(id_apprenant: number,token : string): Promise<Apprenant | null> {
  const session = await auth()
  if(!session?.user.roles.includes("ROLE_COORDINATEUR")){console.log("You're not allowed to use this api")}
  const res = await fetch(`${BASE_URL}/api/apprenant/${id_apprenant}`, {
    cache: 'no-store',
    headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
  });

  if (!res.ok) return null;

  return res.json();
}

export async function deleteApprenant(id_apprenant : number, token: string){
  const session = await auth()
  if(!session?.user.roles.includes("ROLE_COORDINATEUR")){console.log("You're not allowed to use this api")}
    const res = await fetch(`${BASE_URL}/api/apprenant/delete/${id_apprenant}`,
        {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
        }

    )
    if (!res.ok) {
        throw new Error(`Failed to delete apprenant with id ${id_apprenant}`);
      }

    revalidatePath('/apprenants');
    return res.status === 204 ? null : await res.json(); // Symfony might return 204 No Content
      
}
