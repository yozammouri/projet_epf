'use server';

import { BASE_URL } from "@/lib/constants";
import { registerSchema } from "@/lib/definitions";

export async function register(prevState: any, formData: FormData) {
  const data = {
    nom: formData.get("nom") as string,
    prenom: formData.get("prenom") as string,
    adresse: formData.get("adresse") as string,
    date_naissance: formData.get("date_naissance") as string,
    tel: (formData.get("tel")) as string,
    email: formData.get("email") as string,
    sexe: formData.get("sexe") as string,
    nationalite: formData.get("nationalite") as string,
    profession: formData.get("profession") as string,
    anne_experience: Number(formData.get("anne_experience")),
    dernier_diplome: formData.get("dernier_diplome") as string,
    photo: formData.get("photo") as string,
  };
  
  console.log(`${BASE_URL}`);

  const result = await registerSchema.safeParseAsync(data);

  if (!result.success) {
    return {
      success: false,
      errors: result.error.flatten().fieldErrors,
    };
  }

  try{// ✅ Validation passed — continue with DB logic or file upload here
  const res = await fetch(`${BASE_URL}/api/apprenant/register`,{
    method : 'POST',
    headers : {
      'content-type' : 'application/json'
    },
    body : 
      JSON.stringify({
          nom : result.data.nom,
          prenom : result.data.prenom,
          adresse: result.data.adresse,
          date_naissance : result.data.date_naissance,
          tel : result.data.tel,
          email : result.data.email,
          sexe : result.data.sexe,
          nationnalite : result.data.nationalite,
          profession : result.data.profession,
          anne_experience : result.data.anne_experience,
          dernier_diplome : result.data.dernier_diplome,
          photo : result.data.photo

      }),
  })
      console.log('Response status:', res.status);
      const text = await res.text();
      console.log('Response body:', text);
  }catch(e){
    return {success: false};
  }
  
}
