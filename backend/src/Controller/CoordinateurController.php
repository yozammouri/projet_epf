<?php

namespace App\Controller;

use App\Entity\Coordinateur;
use App\Entity\Formation;
use App\Repository\CoordinateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class CoordinateurController extends AbstractController
{
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
        ]);
    }
}
