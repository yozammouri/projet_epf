import {z} from 'zod'

export const loginSchema = z.object({
  email: z
    .string({ required_error: "Email is required" })
    .min(1, "Email is required")
    .email("Invalid email"),

  password: z
    .string({ required_error: "Password is required" })
    .min(1, "Password is required")
    .min(8, "Password must be more than 8 characters")
    .max(32, "Password must be less than 32 characters"),
    });


// export const responseSchema = z.object({
//   token: z.string(),
//   user: z.object({
//     id: z.number(),
//     name: z.string(),
//     email: z.string().email(),
//     role: z.string(),
//     token: z.string()
//   })
// });


const MAX_FILE_SIZE = 5 * 1024 * 1024 // 5MB
export const registerSchema = z.object({
  nom: z.string().min(1, "Le nom est requis").refine(val => !/^\d/.test(val), {
      message: "Le nom ne doit pas commencer par un chiffre",
    }),
  prenom: z.string().min(1, "Le prénom est requis").refine(val => !/^\d/.test(val), {
      message: "Le nom ne doit pas commencer par un chiffre",
    }),
  adresse: z.string().min(1, "L'adresse est requise"),
  date_naissance: z
    .string()
    .refine(
      (val) => {
        // Check if the string is a valid date and is in the past
        const date = new Date(val);
        const now = new Date();
        return !isNaN(date.getTime()) && date < now;
      },
      { message: "Date de naissance invalide ou dans le futur" }
    ),
  tel: z
    .string()
    .min(8, "Le numéro de téléphone est trop court")
    .max(15, "Le numéro de téléphone est trop long")
    .regex(/^\+?[0-9\s\-]+$/, "Le numéro de téléphone est invalide"),
  email: z.string().email("Email invalide"),
  sexe: z
    .enum(["homme", "femme", "autre"])
    .refine((val) => val !== undefined, {
        message: "Veuillez sélectionner un sexe",
    }),

  nationalite: z
    .enum(["Marocaine", "Française", "Anglaise", "Chinoise", "Espagnole"])
    .refine((val) => val !== undefined, {
        message: "Veuillez sélectionner une nationalité",
    }),
  profession: z.string().min(1, "La profession est requise"),
  anne_experience: z
    .number({ invalid_type_error: "Année d'expérience doit être un nombre" })
    .min(0, "Année d'expérience doit être positive")
    .max(100, "Année d'expérience trop élevée"),
  dernier_diplome: z.string().min(1, "Le dernier diplôme est requis"),
  photo: z
    .any()
    .refine((file) => file && typeof file === "object" && "arrayBuffer" in file, {
      message: "Veuillez télécharger une photo valide",
    })
    .refine(
      async (file) => {
        if (!file || typeof file !== "object" || !("size" in file)) return false
        return file.size <= MAX_FILE_SIZE
      },
      {
        message: "La taille du fichier ne doit pas dépasser 5MB",
      }
    ),
});
