// import { auth } from "@/auth";
// import { Button } from "@/components/ui/button";
// import {getApprenantById} from "@/lib/api/apprenantApi"
// import Link from "next/link";



// export default async function page({ params }: { params: { id_apprenant: number } }) {
//   const session = await auth()
//   if(session?.user.roles.includes("ROLE_COORDINATEUR")){
//     const apprenant = await getApprenantById(params.id_apprenant, session.token);
//     if (!apprenant) console.log("No Apprenant found!");/*return notFound()*/ 

//     return (
//       <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center">
//         <div className="p-[20px] border-1 border-white rp-8 rounded-[5px] shadow-md max-w-md w-[600px]">
//           <h1 className="text-xl font-bold mb-4">Détails de l'étudiant :</h1>
//           <p><strong>ID:</strong> {apprenant?.id_apprenant}</p>
//           <p><strong>Nom:</strong> {apprenant?.user.nom}</p>
//           <p><strong>Prénom:</strong> {apprenant?.user.prenom}</p>
//           <p><strong>Tél:</strong> {apprenant?.tel}</p>
//           <p><strong>Années d'expérience:</strong> {apprenant?.anne_experience} ans</p>
//           <p><strong>Sexe:</strong> {apprenant?.sexe}</p>
//           <p><strong>Nationnalité:</strong> {apprenant?.nationnalite}</p>
//           <p><strong>Profession:</strong> {apprenant?.profession}</p>
          
//         </div>
//         <div className="">
//             <Link href={`/coordinateur`}><Button className="hover:cursor-pointer">Back</Button></Link>
//         </div>
//       </div>
//     );
// }
// return (
//   <div className='flex justify-center items-center h-screen'>
//     <h1 className='font-bold text-red'>You're not authorized to access this ressource!</h1>
//   </div>
// )
// }

import { auth } from '@/auth';
import UpdateApprenantForm from '@/components/reusable/updateApprenant';
import { getApprenantById } from '@/lib/api/apprenantApi'; // You need to implement this if not already
import React from 'react';

export default async function page({ params }: { params: { id_apprenant: number } }) {
  const session = await auth();

  // 🛑 Role guard
  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className="flex justify-center items-center h-screen">
        <h1 className="font-bold text-red-600">
          You're not authorized to access this resource!
        </h1>
      </div>
    );
  }
  const apprenant = await getApprenantById(params.id_apprenant, session.token);
  // if (!apprenant) console.log("No Apprenant found!");/*return notFound()*/
  // const userId: number = session.user.id;
  const token: string = session.token;

  // const apprenant = await getApprenantByUserId(userId, token);

  return (
    <div className="w-full mx-auto rounded-lg shadow-2xl p-6 space-y-5 gap-6 mt-6">
      <UpdateApprenantForm
        defaultValues={{
          nom: apprenant?.user.nom,
          prenom: apprenant?.user.prenom,
          username: apprenant?.user.email,
          adresse: apprenant?.adresse || "",
          date_naissance: apprenant?.date_naissance ,
          sexe: apprenant?.sexe || "",
          nationnalite: apprenant?.nationnalite || "",
          profession: apprenant?.profession || "",
          anne_experience: apprenant?.anne_experience || 0,
          dernier_diplome: apprenant?.dernier_diplome || "",
        }}
        photo={apprenant?.photo}
        apprenantId={apprenant?.id_apprenant}
        token={token}
      />
    </div>
  );
}
