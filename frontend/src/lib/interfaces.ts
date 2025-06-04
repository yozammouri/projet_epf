interface Apprenant{
  id_apprenant: number,
  adresse: string,
  date_naissance: Date,
  tel: number,
  sexe: string,
  nationnalite: string,
  profession: string,
  anne_experience: number,
  dernier_diplome: string,
  photo: string,
  user: USER
}

interface USER {
  id: number,
  nom: string,
  prenom: string,
  email: string
}