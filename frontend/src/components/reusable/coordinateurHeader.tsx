import { auth } from '@/auth'
import React from 'react'
import SignoutButton from './signoutButton'
import { Search } from 'lucide-react'

export default async function () {
    const session = await auth()
    if(!session?.user.roles.includes("ROLE_COORDINATEUR")) return
    return (
        <>
            <header className="w-screen fixed top-0 left-1/2 -translate-x-1/2 flex justify-around items-center py-4 bg-violet-600 shadow-xs z-1">
                    <div>
                    <h1 className='text-lg font-semibold'>
                        Welcome Back <span className='font-bold'>Mr. {session.user.nom} {session.user.prenom}</span>
                    </h1>
                    <div className='text-xs text-white'>{session.user.username}</div>
                    </div>
                    {/* <div className=''><SignoutButton /></div> */}
                    <form className="w-[400px] h-[50px] flex items-center bg-violet-800 rounded-full ">
                        <Search className="text-white ml-4 mr-3 w-5 h-5" />
                        <input
                            type="text"
                            placeholder="type something"
                            className="flex-grow bg-transparent text-white placeholder-white outline-none"
                        />
                        <button
                            type="submit"
                            className="ml-4 bg-gray-200 text-black font-medium px-5 py-2 rounded-full hover:bg-black hover:text-white hover:cursor-pointer transition"
                        >
                            Search
                        </button>
                    </form>
                </header>
        </>
    )
}
