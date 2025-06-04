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

    // #[Route('/api/apprenant/register', name: 'apprenant_register', methods:['POST'])]
    // public function register(Request $request, EntityManagerInterface $em): JsonResponse
    // {
    //     $data = json_decode($request->getContent(), true);
    //     $NewApprenant = new Apprenant();

    //     $form = $this->createForm(ApprenantType::class, $NewApprenant);
    //     $form->submit($data);
        
    //     if (!$form->isValid()) {
    //         $errors = [];
    //         foreach ($form->getErrors(true) as $error) {
    //             $errors[] = $error->getMessage();
    //         }

    //         return new JsonResponse(['errors' => $errors], 400);
    //     }

        
    //     $em->persist($NewApprenant);
    //     $em->flush();


    //     return new JsonResponse(['message' => 'new apprenant saved to database!',
    //         'apprenant' => [
    //             'id' => $NewApprenant->getId(),
    //             'nom' => $NewApprenant->getNom(),
    //             'prenom' => $NewApprenant->getPrenom(),
    //             'adresse' => $NewApprenant->getAdresse(),
    //             'date_naissance' => $NewApprenant->getDateNaissance(),
    //             'tel' => $NewApprenant->getTel(),
    //             'email' => $NewApprenant->getEmail(),
    //             'sexe' => $NewApprenant->getSexe(),
    //             'nationalite' => $NewApprenant->getNationnalite(),
    //             'profession' => $NewApprenant->getProfession(),
    //             'anne_experience' => $NewApprenant->getAnneExperience(),
    //             'dernier_diplome' => $NewApprenant->getDernierDiplome(),
    //             'photo' => $NewApprenant->getPhoto()
    //         ]
    //         ], 201
            
    //     );
    
    // }
}
