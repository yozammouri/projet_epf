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
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use DateTimeImmutable;

final class ConversationController extends AbstractController
{
    #[Route('/api/conversations', name: 'create_conversation', methods: ['POST'])]
    public function createConversation(
        Request $request,
        EntityManagerInterface $em,
        UserRepository $userRepo,
        ConversationRepository $conversationRepo,
        NormalizerInterface $normalizer,
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
            $normalizedData = $normalizer->normalize($existingConversation, null, [
                'groups' => ['conversation:read']
            ]);

            return new JsonResponse([
                'message' => 'this is your existing conversation',
                'conversation' => $normalizedData
            ], 200);
        }

        $conversation = new Conversation();
        $conversation->addUser($currentUser);
        $conversation->addUser($receiver);
        $conversation->setName($data['name']);
        $conversation->setCreatedAt(new DateTimeImmutable());

        $em->persist($conversation);
        $em->flush();
         
        $normalizedData = $normalizer->normalize($conversation, null, [
                'groups' => ['conversation:read']
            ]);

            return new JsonResponse([
                'message' => 'Created a new conversation',
                'conversation' => $normalizedData
            ], 201);
    }

//---------------------------------------------------------------------------------------------------
#[Route('/api/conversations', name: 'get_user_conversations', methods: ['GET'])]
public function getUserConversations(): JsonResponse
{
    /** @var \App\Entity\User $user */
    $user = $this->getUser();

    $conversations = $user->getConversations(); // Assuming mappedBy="users" exists
    // dd($conversations);

    $data = [];

    foreach ($conversations as $conv) {
        $participantIds = array_map(fn($u) => $u->getId(), $conv->getUsers()->toArray());

        $data[] = [
            'id' => $conv->getId(),
            'participants' => $participantIds,
        ];
    }

    return $this->json($data);
}

    
}
