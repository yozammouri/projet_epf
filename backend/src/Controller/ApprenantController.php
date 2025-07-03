<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


final class ApprenantController extends AbstractController
{

    #[Route('/api/apprenant/all', name: 'app_apprenants')]
    public function index(Request $request,ApprenantRepository $ar,EntityManagerInterface $em): JsonResponse
    {
        // $apprenants = $ar->findAll();
        // return $this->json($apprenants, 200, [], ['groups' => 'apprenant:read']);

        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('limit', 5));
        $offset = ($page - 1) * $limit;

        $qb = $em->createQueryBuilder()
            ->select('a')
            ->from(Apprenant::class, 'a')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $paginator = new Paginator($qb, fetchJoinCollection: true);

        $apprenants = iterator_to_array($paginator); // Pour transformer en tableau

        $totalItems = count($paginator);
        $totalPages = ceil($totalItems / $limit);

        return $this->json([
            'data' => $apprenants,
            'pagination' => [
                'current_page' => $page,
                'limit' => $limit,
                'total_items' => $totalItems,
                'total_pages' => $totalPages,
            ]
        ], 200, [], ['groups' => 'apprenant:read']);

    }
    
    #[Route('/api/apprenant/{id}', name: 'app_apprenant_id', requirements: ['id' => '\d+'])]
    public function apprenantById(ApprenantRepository $ar, int $id): Response
    {
        $apprenant = $ar->find($id);
        
        if (!$apprenant) {
            throw $this->createNotFoundException('Apprenant non trouvé.');
        }

        return $this->json($apprenant, 200, [], ['groups' => 'apprenant:read']);

    }

    #[Route('/api/apprenant/delete/{id}', name: 'app_apprenant_delete', requirements: ['id' => '\d+'],methods:['DELETE'])]
    public function deleteApprenant(Apprenant $apprenant, EntityManagerInterface $em): JsonResponse 
    {
        $em->remove($apprenant);
        $em->flush();
        return new JsonResponse([
            'status' => 'success', 
            'message' => 'Apprenant Deleted Successfully'
        ],200);
    }

    #[Route('/api/coordinateur/apprenant/update/{id}', name: 'apprenant_register', methods:['POST'])]
    public function updateApprenant(int $id, Request $request, EntityManagerInterface $em, ApprenantRepository $ar, SerializerInterface $serializer, SluggerInterface $slugger): JsonResponse
    {
        $apprenant = $ar->find($id);

            if (!$apprenant) {
                return new JsonResponse(['error' => 'Apprenant not found'], 404);
            }

            // 🔁 1. Manually get raw fields from the request
            $data = $request->request->all();
            
            // ✅ Fix data types BEFORE deserialization
            if (isset($data['anne_experience'])) {
                $data['anne_experience'] = (int) $data['anne_experience'];
            }

            if (isset($data['date_naissance'])) {
                // Expecting "YYYY-MM-DD" format
                $data['date_naissance'] = (new \DateTime($data['date_naissance']))->format('Y-m-d');
            }

            // 🔁 2. Use serializer to update the entity (only text fields)
            $serializer->deserialize(
                json_encode($data),
                Apprenant::class,
                'json',
                ['object_to_populate' => $apprenant]
            );
            

            // 📂 3. Handle file upload manually
            $file = $request->files->get('photo');

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move($this->getParameter('uploads_directory'), $newFilename);
                    $apprenant->setPhoto('uploads/' . $newFilename);
                } catch (FileException $e) {
                    return new JsonResponse(['error' => 'File upload failed'], 500);
                }
            }

            // 💾 4. Persist changes
            $em->flush();
            
            return new JsonResponse(
                [
                    'message' => 'Coordinateur updated',
                    'apprenant' => [
                        'id' => $apprenant->getIdApprenant(),
                        'adresse' => $apprenant->getAdresse(),
                        'date_naissance' => $apprenant->getDateNaissance(),
                        'tel' => $apprenant->getTel(),
                        'sexe' => $apprenant->getSexe(),
                        'nationalite' => $apprenant->getNationnalite(),
                        'profession' => $apprenant->getProfession(),
                        'anne_experience' => $apprenant->getAnneExperience(),
                        'dernier_diplome' => $apprenant->getDernierDiplome(),
                        'photo' => $apprenant->getPhoto(),
                        'nom' => $apprenant->getUser()->getNom(),
                        'prenom' => $apprenant->getUser()->getPrenom(),
                        'email' => $apprenant->getUser()->getEmail(),
                        
                    ]
                ]);

        
    
    }
}
