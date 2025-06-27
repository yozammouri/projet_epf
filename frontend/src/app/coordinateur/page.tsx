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
    <div className="w-full flex flex-col px-4">
      <div className="flex flex-col lg:flex-row w-full mt-8 sm:mt-[100px] gap-6">
        
        {/* LEFT PANEL */}
        <div className="flex flex-col justify-start w-full lg:max-w-[750px]">
          {/* Header */}
          <div className="flex flex-col sm:flex-row justify-between items-center mb-4">
            <h2 className="font-bold mb-2 sm:mb-0">APPRENANTS LIST:</h2>
            <Link href="/somewhere">
              <Button className="border h-[50px] text-md text-black bg-white hover:bg-black hover:text-white transition-colors duration-200 rounded-md">
                Create Apprenant
              </Button>
            </Link>
          </div>

          {/* Apprenants list */}
          <ul className="bg-white rounded-md shadow-xl min-h-[230px] p-2 mb-4 sm:[592px]">
            {data.map((apprenant: Apprenant) => (
              <ApprenantItem key={apprenant.id_apprenant} apprenant={apprenant} />
            ))}
          </ul>

          {/* Pagination */}
          <div className="w-full flex justify-center gap-4 items-center">
            {apprenantPage > 1 && (
              <Link
                href={`/coordinateur?apprenantPage=${apprenantPage - 1}&formationPage=${formationPage}`}
                className="text-xs hover:-translate-y-1 transition-transform"
              >
                ← Previous
              </Link>
            )}
            <span className="font-bold">{apprenantPage}</span>
            {apprenantPage < pagination.total_pages && (
              <Link
                href={`/coordinateur?apprenantPage=${apprenantPage + 1}&formationPage=${formationPage}`}
                className="text-xs hover:-translate-y-1 transition-transform"
              >
                Next →
              </Link>
            )}
          </div>
        </div>

        {/* RIGHT PANEL */}
        <div className="flex flex-col w-full gap-6">
          {/* Cards (Top) */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
            <div className="relative h-[125px] rounded-xl overflow-hidden shadow-xl">
              <img src="/assets/abstract-black-background.jpg" className="absolute w-full h-full object-cover" />
              <div className="relative p-3 text-white">
                <p>Total Apprenant</p>
                <h1 className="font-bold text-3xl">1277</h1>
                <p className="text-xs"><span className="text-green-500">10%</span> Better than last month!</p>
              </div>
            </div>

            <div className="relative h-[125px] bg-white text-black rounded-xl shadow-xl p-3">
              <p>Total Intervenant</p>
              <h1 className="font-bold text-3xl">98</h1>
              <p className="text-xs"><span className="text-red-500">0.5%</span> Lesser than last month!</p>
            </div>

            <div className="flex flex-col justify-center items-center h-[125px] bg-white text-black rounded-xl shadow-xl">
              <DateTimeDisplay />
            </div>
          </div>

          {/* Bottom: Formations + Events */}
          <div className="flex flex-col lg:flex-row gap-6">
            {/* Formations */}
            <div className="flex flex-col flex-1 bg-white rounded-md shadow-xl p-4 text-black">
              <h1 className="font-bold text-center mb-2">FORMATIONS GÈRÈES</h1>
              <ul className="flex flex-col gap-2 min-h-[250px]">
                {formationData.map((formation: Formation) => (
                  <FormationItem key={formation.id} formation={formation} />
                ))}
              </ul>

              <div className="w-full flex justify-center items-center gap-4 mt-4">
                {formationPage > 1 && (
                  <Link
                    href={`/coordinateur?formationPage=${formationPage - 1}&apprenantPage=${apprenantPage}`}
                    className="text-xs hover:-translate-y-1 transition-transform"
                  >
                    ← Previous
                  </Link>
                )}
                <span className="font-bold">{formationPage}</span>
                {formationPage < formationPagination.total_pages && (
                  <Link
                    href={`/coordinateur?formationPage=${formationPage + 1}&apprenantPage=${apprenantPage}`}
                    className="text-xs hover:-translate-y-1 transition-transform"
                  >
                    Next →
                  </Link>
                )}
              </div>
            </div>

            {/* Events */}
            {/* <div className="flex flex-col items-center justify-start bg-white rounded-md shadow-xl flex-[0.4] p-4">
              <h1 className="font-bold mb-4">EVENTS</h1>
              <div className="flex justify-center items-center h-[200px] w-full">
                <p className="text-xs">No events available</p>
              </div>
            </div> */}
          </div>
        </div>
      </div>

      {/* CHARTS */}
      <div className="w-full mt-12 max-w-screen-xl mx-auto px-4">
        <h2 className="font-bold mb-2">APPLICATION CHARTS:</h2>
        <div className="p-4 min-h-[200px]">
          <Component />
        </div>
      </div>
    </div>

    </>
  )
}
