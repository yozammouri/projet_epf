'use server'

// import { BASE_URL } from "@/lib/constants"
// import { loginSchema } from "@/lib/definitions"
// import { jwtDecode } from "jwt-decode";
import { AuthError } from "next-auth";
import { signIn, signOut } from '@/auth'

// import { cookies } from 'next/headers';


export async function handleCredentialsSignin({ email, password }: {
    email: string,
    password: string
}) {
    try {
        await signIn("credentials", { email, password, redirectTo: "/coordinateur" });
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
    await signOut();
}

// interface UserObject {
//     ip: string,
//     username: string,
//     roles: string[],
//     nom: string,
//     prenom: string
//   }

// interface BackendJWT{
//   token: string,
//   refreshToken: string
// }

// interface Payload extends UserObject{  //decoded jwt
//     jti: string, 
//     iat: number,
//     exp: number,
//   }

// export async function login(prevState: any, formData: FormData) {
//   const validatedFields = loginSchema.safeParse({
//         email: formData.get('email'),
//         password: formData.get('password'),
//       }) 

//   if (!validatedFields.success) {
//         return {
//             success: false,
//             errors: validatedFields.error.flatten().fieldErrors,
//         }
//       }
  
//   try {
//     const response = await fetch(`${BASE_URL}/auth`, {
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json',
//       },
//       body: JSON.stringify(
//         {
//           'email' : validatedFields.data.email,
//           'password' : validatedFields.data.password
//         }
//       ),
//     })

//     // console.log('BASE_URL= '+`${BASE_URL}`)
//     // console.log('process.env.NEXT_PUBLIC_API_URL= '+process.env.NEXT_PUBLIC_API_URL)

//     if (!response.ok) {
//       const error = await response.json()
//       console.log(error)
//       return { error: error.message || 'Invalid credentials' }
//     }

//     const tokens : BackendJWT = await response.json()
//     console.log('🔁 Backend response:', tokens);
//     // console.log('this is your data.token:', data.token);

//     const decodedPayload : Payload = jwtDecode(tokens.token);
//     const refresh : Payload = jwtDecode(tokens.refreshToken);
    
//     console.log('Decoded Payload', decodedPayload);
//     console.log('refresh token data ', refresh.jti);
//     console.log('Le nom de l utilisateur :', decodedPayload.nom);
    
    // (await cookies()).set('jwt', data.token, {
    //   httpOnly: true,
    //   secure: process.env.NODE_ENV === 'production',
    //   sameSite: 'none',
    //   maxAge: 60 * 60,
    //   path: '/',
    // });

    // const jwtCookie = (await cookies()).get('jwt');
    // console.log('cookie stored:', jwtCookie);
    // Here we return it for the client to handle
//     return { token: tokens.token }
//   } catch (err) {
//     // return { error: 'Network or server error' }
//     console.log(err)
//   }
// }