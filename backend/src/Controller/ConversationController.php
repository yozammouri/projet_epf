<?php

namespace App\Controller;

use App\Entity\Conversation;
// use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

final class ConversationController extends AbstractController
{
    #[Route('/api/conversations', name: 'create_conversation', methods: ['POST'])]
    public function createConversation(
        Request $request,
        EntityManagerInterface $em,
        UserRepository $userRepo,
        ConversationRepository $conversationRepo
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $receiverId = $data['receiver_id'] ?? null;
        $currentUser = $this->getUser();

        if (!$currentUser || !$receiverId) {
            return $this->json(['error' => 'Missing data'], 400);
        }

        $receiver = $userRepo->find($receiverId);
        if (!$receiver) {
            return $this->json(['error' => 'Receiver not found'], 404);
        }

        // Check if conversation already exists
        $existingConversation = $conversationRepo->findExistingConversationBetween($currentUser, $receiver);
        if ($existingConversation) {
            return $this->json(['conversation_id' => $existingConversation->getId()], 200);
        }

        $conversation = new Conversation();
        $conversation->addUser($currentUser);
        $conversation->addUser($receiver);
        $conversation->setName($data['name']);
        $conversation->setCreatedAt(new DateTimeImmutable());

        $em->persist($conversation);
        $em->flush();
         
        return $this->json([
            'conversation_id' => $conversation->getId(),
            'conversation_created_at' => $conversation->getCreatedAt(),
            'conversation_name' => $conversation->getName(),
            'conversation_users' => $conversation->getUsers(),
            ]
        , 201);
    }
}
