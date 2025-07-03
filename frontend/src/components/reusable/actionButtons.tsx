import React from 'react'
import { Button } from '../ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '../ui/dialog';
import { auth } from '@/auth';
import DialogDeleteAction from './dialogDeleteAction';
import Link from 'next/link';

export default async function actionButtons({ apprenant }: { apprenant: Apprenant }) {
    const session = await auth();
    if(session?.user && session.user.roles.includes("ROLE_COORDINATEUR")) {
        return (
            <>  
                {/* <Link href="/coordinateur/details/">
                    <Button className="text-sm text-blue-400/100 bg-white hover:bg-blue-400/100 hover:text-white hover:cursor-pointer transition-colors duration-200">
                            Edit
                    </Button>
                </Link> */}

                <Dialog>
                    <DialogTrigger asChild>
                        <Button className="text-sm text-black bg-white hover:text-white hover:cursor-pointer transition-colors duration-200">
                            Delete
                        </Button>
                    </DialogTrigger>
                    <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Are you absolutely sure?</DialogTitle>
                        <DialogDescription>
                        This action cannot be undone. This will permanently delete this apprenant
                        and remove its data from our servers.
                        </DialogDescription> 
                    </DialogHeader>
                    <DialogFooter>
                        
                        <DialogDeleteAction apprenant={apprenant} token={session.token}/>       {/* <<<<-----*/}
                    </DialogFooter>
                    </DialogContent>
                </Dialog> 
            </>
        )
    }
}