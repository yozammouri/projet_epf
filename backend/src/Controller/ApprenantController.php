<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApprenantController extends AbstractController
{
    #[Route('/api/apprenant/register', name: 'apprenant_register', methods:['POST'])]
    public function register(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $NewApprenant = new Apprenant();

        $form = $this->createForm(ApprenantType::class, $NewApprenant);
        $form->submit($data);
        
        if (!$form->isValid()) {
            $errors = [];
            foreach ($form->getErrors(true) as $error) {
                $errors[] = $error->getMessage();
            }

            return new JsonResponse(['errors' => $errors], 400);
        }

        
        $em->persist($NewApprenant);
        $em->flush();


        return new JsonResponse(['message' => 'new apprenant saved to database!',
            'apprenant' => [
                'id' => $NewApprenant->getId(),
                'nom' => $NewApprenant->getNom(),
                'prenom' => $NewApprenant->getPrenom(),
                'adresse' => $NewApprenant->getAdresse(),
                'date_naissance' => $NewApprenant->getDateNaissance(),
                'tel' => $NewApprenant->getTel(),
                'email' => $NewApprenant->getEmail(),
                'sexe' => $NewApprenant->getSexe(),
                'nationalite' => $NewApprenant->getNationnalite(),
                'profession' => $NewApprenant->getProfession(),
                'anne_experience' => $NewApprenant->getAnneExperience(),
                'dernier_diplome' => $NewApprenant->getDernierDiplome(),
                'photo' => $NewApprenant->getPhoto()
            ]
            ], 201
            
        );
    
    }
}
