<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Conversation;
use App\Repository\ConversationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use DateTimeImmutable;


final class MessageController extends AbstractController
{
    #[Route('/api/message', name: 'api_message', methods: ['POST'])]
    public function sendMessage(
        Request $request,
        EntityManagerInterface $em,
        HubInterface $hub,
        ConversationRepository $conversationRepo
    ): JsonResponse 
    {

    $data = json_decode($request->getContent(), true);
        $content = $data['content'] ?? null;
        $conversationId = $data['conversation_id'] ?? null;
        $user = $this->getUser();

        if (!$user || !$content || !$conversationId) {
            return $this->json(['error' => 'Missing data'], 400);
        }

        $conversation = $conversationRepo->find($conversationId);
        if (!$conversation || !$conversation->getUsers()->contains($user)) {
            return $this->json(['error' => 'Conversation not found or access denied'], 403);
        }

        $message = new Message();
        $message->setConversation($conversation);
        $message->setSender($user);
        $message->setContent($content);
        $message->setCreatedAt(new DateTimeImmutable());

        $em->persist($message);
        $em->flush();

    $topic = '/'.$message->getConversation()->getName();

    $update = new Update(
        $topic,
        json_encode([
            'id' => $message->getId(),
            'sender_id' => $message->getSender()->getId(),
            'content' => $message->getContent(),
            'createdAt' => $message->getCreatedAt()->format('c'),
        ])
    );

    $hub->publish($update);
    
    // return $this->json(['status' => 'Message sent']);
    return new JsonResponse([
        'status' => 'Message sent',
        'topic' => $topic,
        'message_id' => $message->getId()
    ], 201);
}

//---------------------------------------------------------------------------------------------------

#[Route('/api/conversations/{id}/messages', name: 'get_messages', methods: ['GET'])]
public function getMessages(
    Conversation $conversation
): JsonResponse {
    $user = $this->getUser();

    if (!$conversation->getUsers()->contains($user)) {
        return $this->json(['error' => 'Unauthorized'], 403);
    }

    $messages = $conversation->getMessages()->map(function (Message $msg) {
        return [
            'id' => $msg->getId(),
            'sender_id' => $msg->getSender()->getId(),
            'sender_prenom' => $msg->getSender()->getPrenom(),
            'content' => $msg->getContent(),
            'created_at' => $msg->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    });

    return $this->json($messages);
}










#[Route('/api/publish', name: 'api_message_test')]
    public function publish(
        HubInterface $hub,
    ): Response {
    $update = new Update(
            '/books/1',
            json_encode(['status' => 'Message Envoyé !']),
            // true
        );

        $hub->publish($update);

        return new Response('published!');
}


}
