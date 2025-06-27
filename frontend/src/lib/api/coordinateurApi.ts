'use server'

import { auth } from '@/auth';
import { BASE_URL } from '@/lib/constants';


export async function getCoordinateurByUserId(id: number, token: string){
  const session = await auth()
  if(!session?.user.roles.includes("ROLE_COORDINATEUR")){console.log("You're not allowed to use this api")}
  const res = await fetch(`${BASE_URL}/api/coordinateur/user/${id}`, {
    cache: 'no-store',
    headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
  });

  const contentType = res.headers.get("content-type");

  if (!res.ok) {
    const text = await res.text();
    console.error("Error response from backend:", text);

    if (contentType && contentType.includes("application/json")) {
      const error = await res.json();
      throw new Error(error.message || "Failed to fetch coordinateur");
    } else {
      throw new Error("Unexpected response from server");
    }
  }

  return res.json();
}

export async function getFormationsByCoordinateur(id: number, page: number, token: string){
    const session = await auth()
    if(!session?.user.roles.includes("ROLE_COORDINATEUR")){console.log("You're not allowed to use this api")}
    const limit = 3;
    const res = await fetch(`${BASE_URL}/api/coordinateur/${id}/formations?page=${page}&limit=${limit}`, {
        cache: 'no-store',
        headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                }
    });

    if (!res.ok) return null;

    return res.json();
}