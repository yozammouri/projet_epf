import React from 'react'
import { auth } from '@/auth'
import Link from 'next/link'
import { Button } from '@/components/ui/button'
import ApprenantItem from '@/components/reusable/apprenantItem'
import { getApprenants } from '@/lib/api/apprenantApi'
import { Component } from '@/components/coordinateur-chart'
import DateTimeDisplay from '@/components/reusable/dateComponent'
import { getCoordinateurByUserId, getFormationsByCoordinateur } from '@/lib/api/coordinateurApi'
import FormationItem from '@/components/reusable/formationItem'

export default async function page({ searchParams }: { searchParams: { apprenantPage?: string, formationPage?: string } }) {

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
  

  const apprenantPage = Number(searchParams.apprenantPage) || 1;
  const formationPage = Number(searchParams.formationPage) || 1;
  const coordinateurConnected = await getCoordinateurByUserId(userId, token)
  const id_coordinateur: number = coordinateurConnected.id_coordinateur
  const formations = await getFormationsByCoordinateur(id_coordinateur, formationPage, token)
  const { formationData, formationPagination } = formations;
  const apprenants = await getApprenants(apprenantPage, token);
  const { data, pagination } = apprenants;
  return (
    <>
      <div className='w-full flex flex-col '>
        <div className='flex w-full h-[400px] mt-[100px] '>
          <div className="flex flex-col justify-center w-[900px]"> {/*TOP LEFT*/}
            <div className="flex justify-between items-center"> {/*Create Apprenant Button*/}
              <div className="font-bold ml-[140px]">APPRENANTS LIST:</div>
              <Link href="/somewhere">
                <Button className="border h-[50px] text-md text-black bg-white hover:cursor-pointer hover:bg-black hover:text-white transition-colors duration-200 rounded-[3px]">Create Apprenant</Button>
              </Link>
            </div>

            <div> {/*Apprenants list*/}
              <ul className="ml-[5px] mt-[5px] bg-white rounded-md shadow-xl min-h-[231.3px]">
                {data.map((apprenant: Apprenant ) => (
                  <ApprenantItem key={apprenant.id_apprenant} apprenant={apprenant}/>
                ))}
              </ul>
            </div>

            <div className="w-[900px] ml-[5px] mt-4 flex justify-evenly items-center space-x-4"> {/*Previous/next buttons*/}
                {apprenantPage > 1 && (
                  <Link
                    href={`/coordinateur?apprenantPage=${apprenantPage - 1}&formationPage=${formationPage}`}
                    className="mr-auto bg-transparant-400 px-4 py-2 rounded text-xs transition-transform duration-100 hover:-translate-y-1"
                  >
                    ← Previous
                  </Link>
                )}
                <div className="">
                  <button
                    className="w-13 h-13 flex items-center justify-center rounded-full bg-none font-bold"
                    aria-label="Page actuelle"
                  >
                    {apprenantPage}
                  </button>
                </div>
                {apprenantPage < pagination.total_pages && (
                  <Link
                    href={`/coordinateur?apprenantPage=${apprenantPage + 1}&formationPage=${formationPage}`}
                    className="ml-auto bg-transparent px-4 py-2 rounded text-xs transition-transform duration-100 hover:-translate-y-1"
                  >
                    Next →
                  </Link>
                )}
            </div>

          </div>
          <div className='flex flex-col w-full'> {/*TOP RIGHT*/}
            <div className='flex w-full h-[200px]'> {/*upper container*/}
              <div className='relative w-[300px] h-[125px] rounded-xl bg-black text-white m-auto shadow-xl'>
                <img className='w-[300px] h-[125px] rounded-xl' src="/assets/abstract-black-background.jpg" />
                <p className='absolute top-[10px] left-[10px]'>Total Apprenant</p>
                <h1 className='absolute top-[44px] left-[10px] font-bold text-3xl'>1277</h1>
                <p className='absolute bottom-[10px] left-[10px] text-xs'><span className='text-green-500'>10%</span> Better than last month!</p>
              </div>
              <div className='relative w-[300px] h-[125px] rounded-xl bg-white text-black m-auto shadow-xl'>
                <p className='absolute top-[10px] left-[10px]'>Total Intervenant</p>
                <h1 className='absolute top-[44px] left-[10px] font-bold text-3xl'>98</h1>
                <p className='absolute bottom-[10px] left-[10px] text-xs'><span className='text-red-500'>0.5%</span> Lesser than last month!</p>
              </div>
              <div className='relative flex flex-col justify-center items-center w-[300px] h-[125px] rounded-xl bg-white text-black m-auto shadow-xl'>
                <DateTimeDisplay />
              </div>
            </div>
            <div className='flex w-full h-full'> {/*bottom container*/}
                <div className='flex flex-col w-[628px] h-full mx-auto rounded-md bg-white text-black shadow-xl'> {/*left container*/}
                  <h1 className='font-bold mx-auto mt-[10px]'>FORMATIONS GÈRÈES</h1>
                  <ul className="flex flex-col justify-center items-center ml-[5px] mt-[5px] bg-white rounded-md min-h-[250px]">
                    {formationData.map((formation: Formation) => (
                      <FormationItem key={formation.id} formation={formation} />
                    ))}
                  </ul>
                  <div className="w-[627.99px] ml-[5px] flex justify-evenly items-center space-x-4"> {/*Previous/next buttons formations*/}
                    { formationPage > 1 && (
                      <Link
                        href={`/coordinateur?formationPage=${formationPage - 1}&apprenantPage=${apprenantPage}`}
                        className="mr-auto bg-transparant-400 px-4 py-2 rounded text-xs transition-transform duration-100 hover:-translate-y-1"
                      >
                        ← Previous
                      </Link>
                    )}
                    <div className="">
                      <button
                        className="w-13 h-13 flex items-center justify-center rounded-full bg-none font-bold"
                        aria-label="Page actuelle"
                      >
                        {formationPage}
                      </button>
                    </div>
                    {formationPage < formationPagination.total_pages && (
                      <Link
                        href={`/coordinateur?formationPage=${formationPage + 1}&apprenantPage=${apprenantPage}`}
                        className="ml-auto bg-transparent px-4 py-2 rounded text-xs transition-transform duration-100 hover:-translate-y-1"
                      >
                        Next →
                      </Link>
                    )}
                  </div>
                </div>
                <div className='flex flex-col items-center w-[300px] h-full mx-auto rounded-md bg-white text-black shadow-xl'> {/*right container*/}
                  <div className='flex justify-center items-center mt-[10px] w-full'>
                    <h1 className='font-bold'>EVENTS</h1>
                  </div>
                  <div className='flex justify-center items-center mt-[40px] w-full h-[200px] '>
                    <h1 className='text-xs'>No events available</h1>
                  </div>
                </div>
            </div> 
          </div>
        </div>

        <div className="flex justify-center mt-[55px]"> {/*Charts*/}
          <div className="w-full max-w-[1600px] h-[400px] min-h-[200px]">
            <div className="font-bold mb-2">APPLICATION CHARTS:</div>
            <Component />
          </div>
        </div>
      </div>
    </>
  )
}
