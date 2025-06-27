'use client'

import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { z } from "zod";
import { updateCoordinateurSchema } from "@/lib/definitions";
import { BASE_URL } from "@/lib/constants";
import { useState } from "react";
import { toast } from "sonner";
import { useRouter } from "next/navigation";


type FormData = z.infer<typeof updateCoordinateurSchema>;

export default function CoordinatorForm({
  defaultValues,
  photo,
  coordinateurId,
  token,
}: {
  defaultValues: FormData;
  photo?: string;
  coordinateurId: number;
  token: string;
}) {
  console.log("photo de profile", photo)
      const router = useRouter()

  const [photoFile, setPhotoFile] = useState<File | null>(null)
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormData>({
    resolver: zodResolver(updateCoordinateurSchema),
    defaultValues,
  });

  const onSubmit = async (data: FormData) => {
    const formData = new FormData()

    // Append text fields
    formData.append('nom', data.nom)
    formData.append('prenom', data.prenom)
    formData.append('adresse', data.adresse)
    formData.append('tel', data.tel)
    formData.append('matricule', data.matricule)

    // Append file (optional)
    if (photoFile) {
      formData.append('photo', photoFile)
    }

    try {
      const res = await fetch(`${BASE_URL}/api/coordinateur/update/${coordinateurId}`, {
        method: "POST",
        headers: { 
          "Authorization": `Bearer ${token}`
        },
        
        // body: JSON.stringify(data),
        body: formData
      });

      if (!res.ok) {
        const text = await res.text();
        console.error("Error response from backend:", text);
        // alert("Something went wrong");
        toast.error("Something went wrong !❌")
      }
      
      // alert("Profile updated successfully");
      toast.success(`Updated successfully !✅`);
      router.refresh();
    } catch (err) {
      console.error(err);
      
    }
  };

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-5">
      <div className="flex flex-col justify-center items-center group w-[200px] h-[200px] relative rounded-full hover:cursor-pointer">
        {/* 🖼️ Display current photo */}
        {photo && (
          <img
            src={`http://localhost/${photo}`}
            alt="Profile"
            className="absolute w-full h-full object-cover rounded-full"
          />
        )}

        {/* 🗂️ File input overlay */}
        <div className="absolute w-full h-full inset-0 flex items-center justify-center bg-black/60 text-white text-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
          <Input
            type="file"
            accept="image/*"
            onChange={(e) => setPhotoFile(e.target.files?.[0] || null)}
            className="w-full h-full opacity-0 hover:cursor-pointer"
          />
          <span className="absolute">Change Image</span>
        </div>
      </div>

      <div className="flex flex-col">
        <div className="font-semibold">{defaultValues.username}</div>
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Nom</label>
        <Input {...register("nom")} />
        {errors.nom && <p className="text-sm text-red-500">{errors.nom.message}</p>}
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Prénom</label>
        <Input {...register("prenom")} />
        {errors.prenom && <p className="text-sm text-red-500">{errors.prenom.message}</p>}
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Email</label>
        <Input className="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded text-gray-300 text-sm" 
        {...register("username")} 
        disabled/>
        <p className="text-xs text-gray-400 mt-1">Available change in 25/04/2024</p>
      </div>    

      <div>
        <label className="text-sm font-medium text-gray-400">Status recently</label>
        <Input defaultValue="On duty" />
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">About me</label>
        <Textarea 
        defaultValue="Discuss only on work hour, unless you wanna discuss about music 🫱🏻"
        rows={4}
        />
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Adresse</label>
        <Textarea rows={3} {...register("adresse")} />
        {errors.adresse && <p className="text-sm text-red-500">{errors.adresse.message}</p>}
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Tél</label>
        <Input {...register("tel")} />
        {errors.tel && <p className="text-sm text-red-500">{errors.tel.message}</p>}
      </div>

      <div>
        <label className="text-sm font-medium text-gray-400">Matricule</label>
        <Input {...register("matricule")} />
        {errors.matricule && <p className="text-sm text-red-500">{errors.matricule.message}</p>}
      </div>

      <Button type="submit" className="w-[170px] bg-green-600 text-white hover:bg-green-500 hover:cursor-pointer">
        Save Changes
      </Button>
    </form>
  );
}