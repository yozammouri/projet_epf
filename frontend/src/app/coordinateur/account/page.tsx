import { auth } from '@/auth';
import CoordinatorForm from '@/components/reusable/updateCoordinateur';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { getCoordinateurByUserId } from '@/lib/api/coordinateurApi';
import React from 'react'

export default async  function page() {
  const session = await auth()
  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className='flex justify-center items-center h-screen'>
        <h1 className='font-bold text-red-600'>You're not authorized to access this resource!</h1>
      </div>
    )
  }
  const userId: number = session.user.id;
  const token: string = session.token;
  const coordinateurConnected = await getCoordinateurByUserId(userId, token)

  return (
      <div className="w-full mx-auto rounded-lg shadow-2xl p-6 space-y-5 gap-6 mt-6">
        {/* Profile Picture */}
        <div className="flex flex-col items-center w-[200px] mt-16 gap-4">
          <div className="text-gray-500 text-xs">Profile picture</div>
        </div>
        <CoordinatorForm
          defaultValues={{
            nom: session.user.nom,
            prenom: session.user.prenom,
            username: session.user.username,
            adresse: coordinateurConnected.adresse || "",
            tel: coordinateurConnected.tel || "",
            matricule: coordinateurConnected.matricule || "",
          }}
          photo={coordinateurConnected.photo}
          coordinateurId={coordinateurConnected.id_coordinateur}
          token={token}
        />
      </div>
  );
}
