// 'use client'

// import { useActionState, useState } from 'react'
// import { login } from '../../actions/auth/login'
// import { useEffect } from 'react'
// import { Button } from '../ui/button'
// import { toast} from 'sonner'
// import { signIn } from 'next-auth/react'
// import { loginSchema } from '@/lib/definitions'

// export default function LoginForm() {
    
//   const [state, formAction, pending] = useActionState(login, undefined)

//   useEffect(() => {
//     if (state?.token) {
//       // Redirect or show success message
//       window.location.href = '/dashboard' // or use router.push('/dashboard')
//     } else{
//       toast.error(
//         "Something wrong happened !"
//       )
//     }
//   }, [state])

// // const [pending, setPending] = useState(false)

//   // const handleSubmit = async (formData: FormData) => {
//   //   const email = formData.get("email")
//   //   const password = formData.get("password")

//   //   const result = loginSchema.safeParse({ email, password })

//   //   if (!result.success) {
//   //     toast.error("Invalid form data")
//   //     return 
//     //   {
//     //     success: false,
//     //     errors: result.error.flatten().fieldErrors,
//     //   }
//     // }

//   //   setPending(true)

//   //   const res = await signIn("credentials", {
//   //     email: result.data.email,
//   //     password: result.data.password,
//   //     redirect: false,
//   //   })

//   //   setPending(false)

//   //   if (res?.ok) {
//   //     toast.success("Login successful!")
//   //     window.location.href = "/coordinateur"
//   //   } else {
//   //     toast.error("Invalid credentials")
//   //   }
//   // }

//   return (
//     <>
//     <div className="flex justify-center w-screen h-screen items-center">
//         <form action={formAction} 
//               className="w-1/4 space-y-6">
//           <div className="space-y-12">
//             <div className="border-b border-gray-900/10 pb-12">
//             <h1 className='items-center font-bold '>LOGIN</h1>
//               <div className="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
//                 <div className="sm:col-span-4">
//                   <label htmlFor='email' className="block text-sm/6 font-medium text-gray-900">
//                     E-mail
//                   </label>
//                   <div className="mt-2">
//                     <div className="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
//                       <input
//                         id="email"
//                         name="email"
//                         type="text"
//                         placeholder="DOE.Jhon@gmail.com"
//                         className="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
//                       />  
//                     </div>
//                     {/* Render error message for 'nom' */}
//                     {state?.errors?.email && (
//                       <p className="mt-1 text-sm text-red-600">{state.errors.email}</p>
//                     )}
//                   </div>
//                 </div>
                
//                 <div className="sm:col-span-4">
//                   <label htmlFor="password" className="block text-sm/6 font-medium text-gray-900">
//                     Password
//                   </label>
//                   <div className="">
//                     <div className="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
//                       <input
//                         id="password"
//                         name="password"
//                         type="password"
//                         autoComplete="new-password"
//                         placeholder="Your password"
//                         className="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
//                       />  
//                     </div>
//                     {/* Render error message for 'prenom' */}
//                     {state?.errors?.password && (
//                       <p className="mt-1 text-sm text-red-600">{state.errors.password}</p>
//                     )}
//                   </div>
//                 </div>

//               </div>
//               <div className="mt-8 flex">
//                 <Button
//                   type="submit"
//                 //   disabled={pending}
//                   className="rounded-md px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
//                 >
//                   Login
//                 </Button>
//               </div>
//             </div>
//           </div>
//           {state?.error && <p className="text-red-600">{state.error}</p>}
//         </form>
//       </div>
//       </>
//   )
// }

