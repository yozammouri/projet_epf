"use server"


import { AuthError } from "next-auth";
import { auth, signIn, signOut } from '@/auth'
import { redirect } from "next/navigation";

export async function handleCredentialsSignin({ email, password }: {
    email: string,
    password: string
}) {
    // const session = await auth()
    try {
        await signIn("credentials", { email, password, redirect:false});
        // if(session?.user.roles.includes("ROLE_COORDINATEUR")){redirect("/coordinateur")}
        // if(session?.user.roles.includes("ROLE_APPRENANT")){redirect("/apprenant")}

        
    } catch (error) {
        if (error instanceof AuthError) {
            switch (error.type) {
                case 'CredentialsSignin':
                    return {
                        message: 'Invalid credentials',
                    }
                default:
                    return {
                        message: 'Something went wrong.',
                    }
            }
        }
        throw error;
    }
}
export async function handleSignOut() {
    await signOut({redirectTo:"/login"});
}