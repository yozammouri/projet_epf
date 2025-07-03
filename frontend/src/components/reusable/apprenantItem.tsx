import Link from 'next/link';
import React from 'react'
import { auth } from '@/auth';
import ActionButtons from './actionButtons';
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"
import { Button } from '../ui/button';

export default async function ApprenantItem({ apprenant }: { apprenant: Apprenant }) {
       const session = await auth();
    if(session?.user.roles.includes("ROLE_COORDINATEUR")) { 
      // const apprenant = await getApprenantById(params.id_apprenant, session.token);
    
      return (
        <div className="w-full mx-auto">
          <li key={apprenant.id_apprenant} className="grid grid-cols-4 items-center py-5 border-b">
            
            {/* Colonne 1 : Image & Nom */}
            <div className="flex items-center justify-evenly gap-2">
              {/* <img alt="" src="../../favicon.ico" className="w-6 h-6 rounded-full bg-gray-50" /> */}
              <Avatar>
              <AvatarImage src="https://github.com/leerob.png" alt="@leerob" />
              <AvatarFallback>LR</AvatarFallback>
              </Avatar>
              <div>
                <p className="text-sm font-semibold text-gray-900">
                  {apprenant.user.nom} {apprenant.user.prenom}
                </p>
                <p className="text-xs text-gray-500">{apprenant.user.email}</p>
              </div>
            </div>

            {/* Colonne 2 : Détails */}
            <div className='ml-[60px]'>
              <Link
                href={`/coordinateur/apprenants/details/${apprenant.id_apprenant}`}
                className="group relative text-black text-sm"
              >
                Details
                <span className="absolute bottom-0 left-0 h-[1px] w-0 bg-black transition-all duration-200 group-hover:w-full" />
              </Link>
            </div>

            {/* Colonne 3 : Status */}
            <div className="flex items-center gap-1">
              <div className="rounded-full bg-blue-500/20 p-1">
                <div className="w-1.5 h-1.5 rounded-full bg-blue-500" />
              </div>
              <p className="text-xs text-gray-500">Online</p>
            </div>

            {/* Colonne 4 : Actions */}
            <div className="flex justify-end gap-1">
              <Link href="/coordinateur/details/">
                  <Button className="text-sm text-blue-400/100 bg-white hover:bg-blue-400/100 hover:text-white hover:cursor-pointer transition-colors duration-200">
                    Edit
                  </Button>                
              </Link>
              <ActionButtons apprenant={apprenant} />
            </div>
          </li>
        </div>

      );
    }
}
