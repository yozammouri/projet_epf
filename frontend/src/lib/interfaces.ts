interface Coordinateur {
  id_coordinateur: number,
  adresse: string,
  tel: string,
  matricule: string,
  photo: string,
  user: USER
}


interface Apprenant {
  id_apprenant: number,
  adresse: string,
  date_naissance: Date,
  tel: string,
  sexe: string,
  nationnalite: string,
  profession: string,
  anne_experience: number,
  dernier_diplome: string,
  photo: string,
  user: USER
}

interface Formation {
  id: number,
  name: string,
  description: string,
  promotions: [],
  catalogue: [],
  objectifs: string,
  prerequis: string,
  public: string,
  categorie: string,
  volume_horaire: number,
  lieux: string 
}

interface USER {
  id: number,
  nom: string,
  prenom: string,
  email: string
}

interface Message {
  id: number;
  sender: number;
  receiver: number;
  content: string;
  createdAt: string;
}
