<?php

namespace App\Controller;

use App\Entity\Coordinateur;
use App\Entity\Formation;
use App\Repository\CoordinateurRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
// use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class CoordinateurController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function test(CoordinateurRepository $coordinateurRepository): JsonResponse
    {
        // phpinfo();
        $coordinateur= $coordinateurRepository->findAll();
        return new JsonResponse($coordinateur);
        // return new JsonResponse("HI");
    }

    #[Route('/api/coordinateur/all', name: 'app_coordinateur')]
    public function index(Request $request,EntityManagerInterface $em): JsonResponse
    {
        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('limit', 1));
        $offset = ($page - 1) * $limit;

        $qb = $em->createQueryBuilder()
            ->select('c')
            ->from(Coordinateur::class, 'c')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new Paginator($qb, fetchJoinCollection: true);
        $coordinateurs = iterator_to_array($paginator); // Pour transformer en tableau

        $totalItems = count($paginator);
        $totalPages = ceil($totalItems / $limit);

        return $this->json([
            'data' => $coordinateurs,
            'pagination' => [
                'current_page' => $page,
                'limit' => $limit,
                'total_items' => $totalItems,
                'total_pages' => $totalPages,
            ]
        ], 200, [], ['groups' => 'coordinateur:read']);
    }

    #[Route('/api/coordinateur/{id}/formations', name: 'coordinateur_formations')]
    public function getFormationsByCoordinateur(int $id, Request $request, EntityManagerInterface $em): JsonResponse 
    {
        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('limit', 4));
        $offset = ($page - 1) * $limit;

        $qb = $em->createQueryBuilder();

        $qb->select('f')
            ->from(Formation::class, 'f')
            ->innerJoin('f.coordinateurs', 'c')
            ->where('c.id_coordinateur = :coordinateur_id')
            ->setParameter('coordinateur_id', $id)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($qb);

        $formations = iterator_to_array($paginator); // convert to array for serialization
        $totalItems = count($paginator);
        $totalPages = ceil($totalItems / $limit);

        return $this->json([
            'formationData' => $formations,
            'formationPagination' => [
                'current_page' => $page,
                'limit' => $limit,
                'total_items' => $totalItems,
                'total_pages' => $totalPages,
            ]
        ], 200, [], ['groups' => 'formation:read']);
    }

    #[Route('/api/coordinateur/user/{id}', name: 'get_coordinateur_by_user_id', methods: ['GET'])]
    public function getCoordinateurByUserId(int $id, CoordinateurRepository $coordinateurRepository): JsonResponse
    {
        $coordinateur = $coordinateurRepository->findOneBy(['user' => $id]);

        if (!$coordinateur) {
            return $this->json(['message' => 'Coordinateur not found'], 404);
        }

        return $this->json([
            'id_coordinateur' => $coordinateur->getIdCoordinateur(),
            // Ajoutez ici d'autres champs à retourner selon vos besoins
            'adresse' => $coordinateur->getAdresse(), // exemple
            'tel' => $coordinateur->getTel(),
            'matricule' => $coordinateur->getMatricule(),
            'photo' => $coordinateur->getPhoto()
        ]);
    }

        #[Route('/api/coordinateur/update/{id}', name: 'update_coordinateur', methods: ['POST', 'PUT'])]
        public function updateCoordinateur(int $id, Request $request, EntityManagerInterface $em, CoordinateurRepository $cr, UserRepository $ur,SerializerInterface $serializer, SluggerInterface $slugger): JsonResponse
        {
            // $coordinateur = $cr->find($id);
            // if (!$coordinateur) {
            //     return new JsonResponse(['error' => 'Coordinateur not found'], 404);
            // }

            // // Deserialize and populate existing object (not create new)
            // $serializer->deserialize(
            //     $request->getContent(),
            //     Coordinateur::class,
            //     'json',
            //     ['object_to_populate' => $coordinateur]
            // );

            // $em->flush();

            // return new JsonResponse(['message' => 'Coordinateur updated'], 200);
            
            $coordinateur = $cr->find($id);

            if (!$coordinateur) {
                return new JsonResponse(['error' => 'Coordinateur not found'], 404);
            }

            // 🔁 1. Manually get raw fields from the request
            $data = $request->request->all();

            $user = $coordinateur->getUser();

            if (isset($data['nom'])) {
                $user->setNom($data['nom']);
            }
            if (isset($data['prenom'])) {
                $user->setPrenom($data['prenom']);
            }
            if (isset($data['email'])) {
                $user->setEmail($data['email']);
            }

            // 🔁 2. Use serializer to update the entity (only text fields)
            $serializer->deserialize(
                json_encode($data),
                Coordinateur::class,
                'json',
                ['object_to_populate' => $coordinateur]
            );
            

            // 📂 3. Handle file upload manually
            $file = $request->files->get('photo');

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move($this->getParameter('uploads_directory'), $newFilename);
                    $coordinateur->setPhoto('uploads/' . $newFilename);
                } catch (FileException $e) {
                    return new JsonResponse(['error' => 'File upload failed'], 500);
                }
            }

            // 💾 4. Persist changes
            $em->flush();
            
            return new JsonResponse(
                [
                    'message' => 'Coordinateur updated',
                    'Coordinateur_prenom' => $coordinateur->getUser()->getPrenom()
                ]);

        }
}
