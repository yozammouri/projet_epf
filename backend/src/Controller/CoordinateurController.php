<?php

namespace App\Controller;

use App\Repository\CoordinateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CoordinateurController extends AbstractController
{
    #[Route('/api/coordinateur/all', name: 'app_coordinateur')]
    public function index(CoordinateurRepository $cReop): JsonResponse
    {
        $coord = $cReop->findOneBy(['id_coordinateur'=>2]);
        $coordinateur = $cReop->findAll();
        return $this->json($coordinateur);
        // return new JsonResponse([
        //     'data'=>12344,
        //     'user'=> $this->getUser()->getUserIdentifier()
        // ]);

        
    }
}
