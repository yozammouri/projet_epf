import { auth } from "@/auth";
import { Button } from "@/components/ui/button";
import {getApprenantById} from "@/lib/api/apprenantApi"
import Link from "next/link";



export default async function page({ params }: { params: { id_apprenant: number } }) {
  const session = await auth()
  if(session?.user.roles.includes("ROLE_COORDINATEUR")){
    const apprenant = await getApprenantById(params.id_apprenant, session.token);
    if (!apprenant) console.log("No Apprenant found!");/*return notFound()*/ 

    return (
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center">
        <div className="bg-white p-8 rounded shadow-md max-w-md w-[600px]">
          <h1 className="text-xl font-bold mb-4">Détails de l'étudiant :</h1>
          <p><strong>ID:</strong> {apprenant?.id_apprenant}</p>
          <p><strong>Nom:</strong> {apprenant?.user.nom}</p>
          <p><strong>Prénom:</strong> {apprenant?.user.prenom}</p>
          <p><strong>Années d'expérience:</strong> {apprenant?.anne_experience} ans</p>
          <p><strong>Sexe:</strong> {apprenant?.sexe}</p>
          <p><strong>Nationnalité:</strong> {apprenant?.nationnalite}</p>
          <p><strong>Profession:</strong> {apprenant?.profession}</p>
          
        </div>
        <div className="">
            <Link href="/coordinateur"><Button className="hover:cursor-pointer">Back</Button></Link>
        </div>
      </div>
    );
}
return (
  <div className='flex justify-center items-center h-screen'>
    <h1 className='font-bold text-red'>You're not authorized to access this ressource!</h1>
  </div>
)
}