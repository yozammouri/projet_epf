import { auth } from '@/auth'
import React from 'react'
import { Search } from 'lucide-react'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { ModeToggle } from './themeButton'
import { handleSignOut } from '@/actions/auth/login'
import { Avatar, AvatarFallback, AvatarImage } from '../ui/avatar'

export default async function () {
    const session = await auth()
    if(!session?.user.roles.includes("ROLE_COORDINATEUR")) return 
    return (
        <>
            <header className="w-screen fixed top-0 left-1/2 -translate-x-1/2 flex justify-end items-center py-4 bg-violet-600 shadow-xs z-1">
                    <div className='mr-[700px]'>
                        <h1 className='text-lg font-semibold'>
                            Welcome Back <span className='font-bold'>Mr. {session.user.nom} {session.user.prenom}</span>
                        </h1>
                        <div className='text-xs text-white'>{session.user.username}</div>
                    </div>
                    {/* <div className=''><SignoutButton /></div> */}
                    <div className='w-[600px] flex items-center'>
                        <form className="w-[400px] h-[50px] flex items-center bg-violet-800 rounded-[5px] ">
                            <Search className="text-white ml-4 mr-3 w-5 h-5" />
                            <input
                                type="text"
                                placeholder="type something"
                                className="flex-grow bg-transparent text-white placeholder-white outline-none"
                            />
                            <button
                                type="submit"
                                className="h-[40px] ml-4 bg-gray-200 text-black font-medium px-5 py-2 rounded-[5px] hover:bg-black hover:text-white hover:cursor-pointer transition"
                            >
                                Search
                            </button>
                        </form>
                        <div className='ml-[20px] w-[100px] flex justify-between items-center'>
                            <DropdownMenu>
                            <DropdownMenuTrigger>
                                <img src="/assets/notification.svg" alt="notification_icon" className='w-[25px] h-[27px] hover:cursor-pointer hover:bg-violet-700' />
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem className="hover:cursor-pointer focus:text-white focus:bg-violet-600 transition">messages</DropdownMenuItem>
                                <DropdownMenuItem className="hover:cursor-pointer focus:text-white focus:bg-violet-600 transition">news</DropdownMenuItem>
                            </DropdownMenuContent>
                            </DropdownMenu>
                            <DropdownMenu>
                            <DropdownMenuTrigger className='flex justify-center items-center'>
                                {/* <img src="/assets/settings.svg" alt="settings_icon" className='w-[27px] h-[25px] hover:cursor-pointer hover:bg-violet-700' /> */}
                                <Avatar>
                                    <AvatarImage className='hover:cursor-pointer hover:bg-violet-700' src="https://github.com/shadcn.png" alt="@shadcn" />
                                </Avatar>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem className="hover:cursor-pointer focus:text-white focus:bg-violet-600 transition">account</DropdownMenuItem>
                                    <form action={handleSignOut}>
                                        <button type="submit">
                                            <DropdownMenuItem className="w-[120px] focus:bg-red-500 focus:text-white cursor-pointer transition">
                                                Sign Out
                                            </DropdownMenuItem>
                                        </button>
                                    </form>
                            </DropdownMenuContent>
                            </DropdownMenu>
                            <ModeToggle />
                        </div>
                    </div>
                </header>
        </>
    )
}
