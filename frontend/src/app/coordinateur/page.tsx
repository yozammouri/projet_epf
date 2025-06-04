import React from 'react'
import { auth } from '@/auth'
import Link from 'next/link'
// import ApprenantsPage from './apprenants/page'
import { Button } from '@/components/ui/button'
import ApprenantItem from '@/components/reusable/apprenantItem'
import { getApprenants } from '@/lib/api/apprenantApi'

export default async function page({ searchParams }: { searchParams: { page: number } }) {

  const session = await auth()
  if (!session?.user.roles.includes("ROLE_COORDINATEUR")) {
    return (
      <div className='flex justify-center items-center h-screen'>
        <h1 className='font-bold text-red-600'>You're not authorized to access this resource!</h1>
      </div>
    )
  }
  const page = Number(searchParams.page) || 1;
  const apprenants = await getApprenants(page, session.token);
  const { data, pagination } = apprenants;
  return (
    <div className="relative flex flex-col"> {/* Reserve space for sidebar */}
      <main className="mt-[100px] flex-1 p-6 max-w-7xl mx-auto w-full space-y-6">
        <div className="flex justify-end">
          <Link href="/somewhere">
            <Button className="border h-[50px] text-md text-black bg-white hover:cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">Create Apprenant</Button>
          </Link>
        </div>

        <div>
          <ul className="bg-white p-6 rounded-xl shadow-xl">
            {data.map((apprenant: Apprenant) => (
              <ApprenantItem key={apprenant.id_apprenant} apprenant={apprenant} />
            ))}
          </ul>
        </div>
        <div className="mt-4 flex items-center space-x-4">
            {page > 1 && (
              <Link
                href={`/coordinateur?page=${page - 1}`}
                className="bg-gray-200 px-4 py-2 rounded hover:bg-gray-400 transition"
              >
                ← Previous
              </Link>
            )}
            <div className="absolute left-1/2 transform -translate-x-1/2">
              <button
                className="w-13 h-13 flex items-center justify-center rounded-full bg-none text-black font-bold"
                aria-label="Page actuelle"
              >
                {"Page "+page}
              </button>
            </div>
            {page < pagination.total_pages && (
              <Link
                href={`/coordinateur?page=${page + 1}`}
                className="bg-gray-200 px-4 py-2 rounded ml-auto hover:bg-gray-400 transition"
              >
                Next →
              </Link>
            )}
        </div>
      </main>
    </div>
  )
}
