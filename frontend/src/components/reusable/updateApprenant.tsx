// 'use client'

// import { useForm } from "react-hook-form";
// import { zodResolver } from "@hookform/resolvers/zod";
// import { Input } from "@/components/ui/input";
// import { Textarea } from "@/components/ui/textarea";
// import { Button } from "@/components/ui/button";
// import { z } from "zod";
// import { updateApprenantSchema } from "@/lib/definitions";
// import { BASE_URL } from "@/lib/constants";
// import { useState } from "react";
// import { toast } from "sonner";
// import { useRouter } from "next/navigation";

// type FormData = z.infer<typeof updateApprenantSchema>;

// export default function UpdateApprenantForm({
//   defaultValues,
//   photo,
//   apprenantId,
//   token,
// }: {
//   defaultValues: FormData;
//   photo?: string;
//   apprenantId?: number;
//   token: string;
// }) {
//   const router = useRouter();
//   const [photoFile, setPhotoFile] = useState<File | null>(null);

//   const {
//     register,
//     handleSubmit,
//     formState: { errors },
//   } = useForm<FormData>({
//     resolver: zodResolver(updateApprenantSchema),
//     defaultValues,
//   });
//   console.log("errors :",errors);
//   const onSubmit = async (data: FormData) => {
//     console.log("Submitting form with:", data);
//     const formData = new FormData();

//     formData.append('nom', data.nom ?? "");
//     formData.append('prenom', data.prenom ?? "");
//     formData.append('username', data.username ?? "");
//     formData.append('adresse', data.adresse ?? "");

//     if (data.date_naissance) {
//     const dateStr = data.date_naissance.toISOString().split("T")[0];
//     formData.append("date_naissance", dateStr);
//     }

//     formData.append('sexe', data.sexe ?? "");
//     formData.append('nationnalite', data.nationnalite ?? "");
//     formData.append('profession', data.profession ?? "");
//     formData.append('anne_experience', (data.anne_experience ?? 0).toString());
//     formData.append('dernier_diplome', data.dernier_diplome ?? "");
//     if (photoFile) {
//       formData.append('photo', photoFile);
//     }

//     try {
//       const res = await fetch(`${BASE_URL}/api/coordinateur/apprenant/update/${apprenantId}`, {
//         method: "POST",
//         headers: {
//           "Authorization": `Bearer ${token}`
//         },
//         body: formData
//       });

//       if (!res.ok) {
//         const errorText = await res.text();
//         console.error("Erreur backend :", errorText);
//         toast.error("Erreur lors de la mise à jour ❌");
//         return;
//       }

//       toast.success("Apprenant mis à jour avec succès ✅");
//       router.refresh();
//     } catch (error) {
//       console.error("Erreur réseau :", error);
//       toast.error("Erreur réseau ❌");
//     }
//   };

//   return (
//     <form onSubmit={handleSubmit(onSubmit)} className="space-y-5">
//       {/* Photo upload section */}
//       <div className="flex flex-col justify-center items-center group w-[200px] h-[200px] relative rounded-full hover:cursor-pointer">
//         {photo && (
//           <img
//             src={`http://localhost/${photo}`}
//             alt="Photo de profil"
//             className="absolute w-full h-full object-cover rounded-full"
//           />
//         )}
//         <div className="absolute w-full h-full inset-0 flex items-center justify-center bg-black/60 text-white text-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
//           <Input
//             type="file"
//             accept="image/*"
//             onChange={(e) => setPhotoFile(e.target.files?.[0] || null)}
//             className="w-full h-full opacity-0 hover:cursor-pointer"
//           />
//           <span className="absolute">Changer l'image</span>
//         </div>
//       </div>

//       <div>
//         <label>Nom</label>
//         <Input {...register("nom")} />
//         {errors.nom && <p className="text-sm text-red-500">{errors.nom.message}</p>}
//       </div>

//       <div>
//         <label>Prénom</label>
//         <Input {...register("prenom")} />
//         {errors.prenom && <p className="text-sm text-red-500">{errors.prenom.message}</p>}
//       </div>

//       <div>
//         <label>Email</label>
//         <Input disabled {...register("username")} />
//         {errors.username && <p className="text-sm text-red-500">{errors.username.message}</p>}
//       </div>

//       <div>
//         <label>Adresse</label>
//         <Textarea rows={3} {...register("adresse")} />
//         {errors.adresse && <p className="text-sm text-red-500">{errors.adresse.message}</p>}
//       </div>

//       {/* <div>
//         <label>Date de naissance</label>
//         <Input type="date" {...register("date_naissance")} />
//         {errors.date_naissance && <p className="text-sm text-red-500">{errors.date_naissance.message}</p>}
//       </div> */}
//       <div>
//         <label className="text-sm font-medium text-gray-400">Date de naissance</label>
//         <Input className="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded text-gray-300 text-sm" 
//         {...register("date_naissance", { valueAsDate: true })} 
//         disabled/>
//         <p className="text-xs text-gray-400 mt-1">Available change in 25/04/2024</p>
//       </div>  

//       <div>
//         <label>Sexe</label>
//         <Input {...register("sexe")} />
//         {errors.sexe && <p className="text-sm text-red-500">{errors.sexe.message}</p>}
//       </div>

//       <div>
//         <label>Nationalité</label>
//         <Input {...register("nationnalite")} />
//         {errors.nationnalite && <p className="text-sm text-red-500">{errors.nationnalite.message}</p>}
//       </div>

//       <div>
//         <label>Profession</label>
//         <Input {...register("profession")} />
//         {errors.profession && <p className="text-sm text-red-500">{errors.profession.message}</p>}
//       </div>

//       <div>
//         <label>Années d'expérience</label>
//         <Input type="number" {...register("anne_experience", { valueAsNumber: true })} />
//         {errors.anne_experience && <p className="text-sm text-red-500">{errors.anne_experience.message}</p>}
//       </div>

//       <div>
//         <label>Dernier diplôme</label>
//         <Input {...register("dernier_diplome")} />
//         {errors.dernier_diplome && <p className="text-sm text-red-500">{errors.dernier_diplome.message}</p>}
//       </div>

//       <Button type="submit" className="bg-blue-600 text-white hover:cursor-pointer hover:bg-blue-500">
//         Enregistrer les modifications
//       </Button>
//     </form>
//   );
// }
'use client'

import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { z } from "zod";
import { updateApprenantSchema } from "@/lib/definitions";
import { BASE_URL } from "@/lib/constants";
import { useState } from "react";
import { toast } from "sonner";
import { useRouter } from "next/navigation";

type FormData = z.infer<typeof updateApprenantSchema>;

export default function UpdateApprenantForm({
  defaultValues,
  photo,
  apprenantId,
  token,
}: {
  defaultValues: FormData;
  photo?: string;
  apprenantId?: number;
  token: string;
}) {
  const router = useRouter();
  const [photoFile, setPhotoFile] = useState<File | null>(null);

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormData>({
    resolver: zodResolver(updateApprenantSchema),
    defaultValues,
  });

  const onSubmit = async (data: FormData) => {
    const formData = new FormData();

    formData.append('nom', data.nom ?? "");
    formData.append('prenom', data.prenom ?? "");
    formData.append('username', data.username ?? "");
    formData.append('adresse', data.adresse ?? "");

    if (data.date_naissance) {
      const dateStr = data.date_naissance.toISOString().split("T")[0];
      formData.append("date_naissance", dateStr);
    }

    formData.append('sexe', data.sexe ?? "");
    formData.append('nationnalite', data.nationnalite ?? "");
    formData.append('profession', data.profession ?? "");
    formData.append('anne_experience', (data.anne_experience ?? 0).toString());
    formData.append('dernier_diplome', data.dernier_diplome ?? "");
    if (photoFile) {
      formData.append('photo', photoFile);
    }

    try {
      const res = await fetch(`${BASE_URL}/api/coordinateur/apprenant/update/${apprenantId}`, {
        method: "POST",
        headers: {
          "Authorization": `Bearer ${token}`
        },
        body: formData
      });

      if (!res.ok) {
        const errorText = await res.text();
        console.error("Erreur backend :", errorText);
        toast.error("Erreur lors de la mise à jour ❌");
        return;
      }

      toast.success("Apprenant mis à jour avec succès ✅");
      router.refresh();
    } catch (error) {
      console.error("Erreur réseau :", error);
      toast.error("Erreur réseau ❌");
    }
  };

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="space-y-6 max-w-4xl mx-auto px-6 py-8 rounded-lg shadow-lg">
      <div className="flex flex-col items-center w-full mt-16 gap-4">
        <div className="text-gray-500 text-xs">{defaultValues.nom} {defaultValues.prenom} </div>
      </div>
      {/* Photo upload section */}
      <div className="flex flex-col justify-center items-center group w-[200px] h-[200px] relative rounded-full mx-auto hover:cursor-pointer mb-8">
        {photo && (
          <img
            src={`http://localhost/${photo}`}
            alt="Photo de profil"
            className="absolute w-full h-full object-cover rounded-full"
          />
        )}
        <div className="absolute w-full h-full inset-0 flex items-center justify-center bg-black/60 text-white text-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
          <Input
            type="file"
            accept="image/*"
            onChange={(e) => setPhotoFile(e.target.files?.[0] || null)}
            className="w-full h-full opacity-0 hover:cursor-pointer"
          />
          <span className="absolute">Changer l'image</span>
        </div>
      </div>

      {/* Nom & Prénom on one row */}
      <div className="flex gap-6">
        <div className="flex-1">
          <label className="block mb-1 font-medium">Nom</label>
          <Input {...register("nom")} />
          {errors.nom && <p className="text-sm text-red-500 mt-1">{errors.nom.message}</p>}
        </div>
        <div className="flex-1">
          <label className="block mb-1 font-medium">Prénom</label>
          <Input {...register("prenom")} />
          {errors.prenom && <p className="text-sm text-red-500 mt-1">{errors.prenom.message}</p>}
        </div>
      </div>

      {/* Email full width */}
      <div>
        <label className="block mb-1 font-medium">Email</label>
        <Input disabled {...register("username")} className="bg-gray-100 cursor-not-allowed" />
        {errors.username && <p className="text-sm text-red-500 mt-1">{errors.username.message}</p>}
      </div>

      {/* Adresse full width textarea */}
      <div>
        <label className="block mb-1 font-medium">Adresse</label>
        <Textarea rows={3} {...register("adresse")} />
        {errors.adresse && <p className="text-sm text-red-500 mt-1">{errors.adresse.message}</p>}
      </div>

      {/* Date de naissance disabled */}
      <div>
        <label className="block mb-1 font-medium text-gray-500">Date de naissance</label>
        <Input
          disabled
          {...register("date_naissance", { valueAsDate: true })}
          className="bg-gray-100 text-gray-400 cursor-not-allowed"
        />
        <p className="text-xs text-gray-400 mt-1 italic">Modification disponible à partir du 25/04/2024</p>
      </div>

      {/* Sexe & Nationalité side-by-side with selects */}
      <div className="flex gap-6">
        <div className="flex-1">
          <label className="block mb-1 font-medium">Sexe</label>
          <select
            {...register("sexe")}
            className="w-full border border-gray-300 rounded px-3 py-2"
            defaultValue={defaultValues.sexe || ""}
          >
            <option value="">-- Choisir --</option>
            <option value="HOME">HOMME</option>
            <option value="FEMME">FEMME</option>
            <option value="AUTRE">AUTRE</option>
          </select>
          {errors.sexe && <p className="text-sm text-red-500 mt-1">{errors.sexe.message}</p>}
        </div>

        <div className="flex-1">
          <label className="block mb-1 font-medium">Nationalité</label>
          <select
            {...register("nationnalite")}
            className="w-full  border border-gray-300 rounded px-3 py-2"
            defaultValue={defaultValues.nationnalite || ""}
          >
            <option className="" value="">-- Choisir --</option>
            <option value="Marocaine">Marocaine</option>
            <option value="Française">Française</option>
            <option value="Algérienne">Algérienne</option>
            <option value="Autre">Autre</option>
          </select>
          {errors.nationnalite && <p className="text-sm text-red-500 mt-1">{errors.nationnalite.message}</p>}
        </div>
      </div>

      {/* Profession & Dernier diplôme side-by-side */}
      <div className="flex gap-6">
        <div className="flex-1">
          <label className="block mb-1 font-medium">Profession</label>
          <Input {...register("profession")} />
          {errors.profession && <p className="text-sm text-red-500 mt-1">{errors.profession.message}</p>}
        </div>

        <div className="flex-1">
          <label className="block mb-1 font-medium">Dernier diplôme</label>
          <Input {...register("dernier_diplome")} />
          {errors.dernier_diplome && <p className="text-sm text-red-500 mt-1">{errors.dernier_diplome.message}</p>}
        </div>
      </div>

      {/* Années d'expérience full width */}
      <div>
        <label className="block mb-1 font-medium">Années d'expérience</label>
        <Input
          type="number"
          min={0}
          max={50}
          step={1}
          {...register("anne_experience", { valueAsNumber: true })}
        />
        {errors.anne_experience && <p className="text-sm text-red-500 mt-1">{errors.anne_experience.message}</p>}
      </div>

      {/* Submit button */}
      <div>
        <Button
          type="submit"
          className="bg-blue-600 text-white hover:cursor-pointer hover:bg-blue-500 font-semibold py-3 rounded shadow"
        >
          Enregistrer les modifications
        </Button>
      </div>
    </form>
  );
}
