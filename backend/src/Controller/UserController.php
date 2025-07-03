<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/api/users', name: 'app_user')]
    public function index(UserRepository $ur, SerializerInterface $serializer): JsonResponse
    {
        $users = $ur->findAll();

    $json = $serializer->serialize(
        $users,
        'json',
        ['groups' => ['conversation:read']] // or apprenant:read, etc.
    );

    return new JsonResponse($json, 200, [], true);
    }
}
