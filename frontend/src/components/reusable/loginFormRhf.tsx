"use client"

import { zodResolver } from "@hookform/resolvers/zod"
import { useForm } from "react-hook-form"
import { z } from "zod"

import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import { loginSchema } from "@/lib/definitions"
import LoadingButton from "./loadingButton"
import { useState } from "react"
import ErrorMessage from "./error-message"
import { handleCredentialsSignin } from "@/actions/auth/login"
import { useRouter } from 'next/navigation'




export default function loginFormRhf() {
    const [globalError, setGlobalError] = useState<string>("");
    const router = useRouter()

    const form = useForm<z.infer<typeof loginSchema>>({
        resolver: zodResolver(loginSchema),
        defaultValues: {
          email: "",
          password: ""
        },
    })

 const onSubmit = async (values: z.infer<typeof loginSchema>) => {
        try {
            const result = await handleCredentialsSignin(values);
            // toast("You submitted the following values:")
            if (result?.message) {
                setGlobalError(result.message);

            }else{
                // ✅ Connexion réussie : refresh session et rediriger
                router.refresh();
                router.push("/login");
            }
        } catch (error) {
            console.log("An unexpected error occurred. Please try again.");
        }
    };

  return (
    <div className="h-screen flex flex-col justify-center items-center">
        {globalError && <ErrorMessage error={globalError} />}
        <Form {...form}>
        <form onSubmit={form.handleSubmit(onSubmit)} className="w-1/5 space-y-6">
            <FormField
            control={form.control}
            name="email"
            render={({ field }) => (
                <FormItem>
                <FormLabel>E-mail</FormLabel>
                <FormControl>
                    <Input placeholder="shadcn" {...field} />
                </FormControl>
                <FormDescription>
                    This is your public display name.
                </FormDescription>
                <FormMessage />
                </FormItem>
            )}
            />
            <FormField
            control={form.control}
            name="password"
            render={({ field }) => (
                <FormItem>
                <FormLabel>Password</FormLabel>
                <FormControl>
                    <Input autoComplete="new-password" type="password" placeholder="shadcn" {...field} />
                </FormControl>
                <FormDescription>
                    This is your password.
                </FormDescription>
                <FormMessage />
                </FormItem>
            )}
            />
            {/* <Button type="submit">Submit</Button> */}
            <LoadingButton
                pending={form.formState.isSubmitting}
            />
        </form>
        </Form>
    </div>
  )
}
