<?php

namespace App\Controller;

use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MercureTokenController extends AbstractController
{
    #[Route('/mercure/token', name: 'mercure_token', methods: ['GET'])]
    public function mercureToken(): JsonResponse
    {
       try {
        $secret = $_ENV['MERCURE_JWT_SECRET'];

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $userId = $user->getId();

        $payload = [
            'mercure' => [
                'subscribe' => ['/books/1'],
                'publish' => ['/books/1'],
            ],
            'iat' => time(),
            'exp' => time() + 3600,
            'user_id' => $userId,
        ];

        $jwt = JWT::encode($payload, $secret, 'HS256');

        return new JsonResponse(['mercure_token' => $jwt], 200);
    } catch (Throwable $e) {
        $logger->error('Mercure token error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return $this->json(['error' => 'Internal Server Error'], 500);
    }
}
}
