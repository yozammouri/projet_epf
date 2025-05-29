'use client'

import React, { useActionState, useState } from 'react' 
import { Button } from "@/components/ui/button"
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import { register } from '@/actions/auth/register'
 
export default function registerForm() {
  const [state, formAction, pending] = useActionState(register, undefined)
  const [nationalite, setNationalite] = useState("")
  const [sexe, setSexe] = useState("")
  return (
    <>
       <div className="flex justify-center items-center min-h-screen bg-gray-100">
      <Card className="w-full max-w-3xl p-6 shadow-xl">
        <CardHeader>
          <CardTitle>Inscription</CardTitle>
          <CardDescription>Remplissez le formulaire pour vous enregistrer.</CardDescription>
        </CardHeader>
        <CardContent>
          <form action={formAction} className="space-y-6">
            {/* Nom & Prenom */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <Label htmlFor="nom">Nom</Label>
                <Input id="nom" name="nom" placeholder="Votre nom" />
                {state?.errors?.nom && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.nom}</p>
                    )}
              </div>
              <div>
                <Label htmlFor="prenom">Prénom</Label>
                <Input id="prenom" name="prenom" placeholder="Votre prénom" />
                {state?.errors?.prenom && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.prenom}</p>
                    )}
              </div>
            </div>

            {/* Adresse & Tél */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <Label htmlFor="adresse">Adresse</Label>
                <Input id="adresse" name="adresse" placeholder="Votre adresse" />
                {state?.errors?.adresse && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.adresse}</p>
                    )}
              </div>
              <div>
                <Label htmlFor="tel">Téléphone</Label>
                <Input id="tel" name="tel" placeholder="Votre numéro de téléphone" />
                {state?.errors?.tel && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.tel}</p>
                    )}
              </div>
            </div>

            {/* Date de naissance */}
            <div>
              <Label htmlFor="date-naissance">Date de naissance</Label>
              <Input id="date-naissance" name="date_naissance" type="date" />
              {state?.errors?.date_naissance && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.date_naissance}</p>
                    )}
            </div>

            {/* Nationalité */}
            <div>
              <Label htmlFor="nationalite">Nationalité</Label>
              {/* <Input id="nationalite" name="nationalite" placeholder="Votre nationalité" /> */}
              <Select onValueChange={setNationalite}>
                <SelectTrigger id="nationalite" name='nationalite'>
                  <SelectValue placeholder="Sélectionner votre nationalité" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="Marocaine">Marocaine</SelectItem>
                  <SelectItem value="Française">Française</SelectItem>
                  <SelectItem value="Anglaise">Anglaise</SelectItem>
                  <SelectItem value="Chinoise">Chinoise</SelectItem>
                  <SelectItem value="Espagnole">Espagnole</SelectItem>
                </SelectContent>
              </Select>
              <input type="hidden" name="nationalite" value={nationalite} />
              {state?.errors?.nationalite && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.nationalite}</p>
                    )}
            </div>

            {/* Profession */}
            <div>
              <Label htmlFor="profession">Profession</Label>
              <Input id="profession" name="profession" placeholder="Votre profession" />
              {state?.errors?.profession && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.profession}</p>
                    )}
            </div>

            {/* Années d'expérience & Diplôme */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <Label htmlFor="experience">Années d'expérience</Label>
                <Input id="experience" name="experience" type="number" placeholder="Ex: 5" />
                {state?.errors?.anne_experience && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.anne_experience}</p>
                    )}
              </div>
              <div>
                <Label htmlFor="diplome">Dernier diplôme</Label>
                <Input id="diplome" name="dernier_diplome" placeholder="Ex: Master, Licence..." />
                {state?.errors?.dernier_diplome && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.dernier_diplome}</p>
                    )}
              </div>
            </div>

            {/* Sexe */}
            <div>
              <Label htmlFor="sexe">Sexe</Label>
              <Select onValueChange={setSexe}>
                <SelectTrigger id="sexe">
                  <SelectValue placeholder="Sélectionner le sexe" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="homme">Homme</SelectItem>
                  <SelectItem value="femme">Femme</SelectItem>
                  <SelectItem value="autre">Autre</SelectItem>
                </SelectContent>
              </Select>
              <input type="hidden" name="sexe" value={sexe} />
              {state?.errors?.sexe && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.sexe}</p>
                    )}
            </div>

            {/* Photo */}
            <div>
              <Label htmlFor="photo">Photo</Label>
              <Input id="photo" name="photo" type="file" />
              {state?.errors?.photo && (
                      <p className="mt-1 text-sm text-red-600">{state.errors.photo}</p>
                    )}
            </div>
            <CardFooter className="flex justify-end gap-4">
              <Button variant="outline">Annuler</Button>
              <Button type="submit" 
                disabled={pending}
              >Enregistrer</Button>
            </CardFooter>
                  
            
          </form>
        </CardContent>
        </Card>
                    
    </div>
  </>
  )
}
