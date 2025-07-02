<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;


final class MessageController extends AbstractController
{
    #[Route('/api/message', name: 'api_message')]
    public function sendMessage(
        Request $request,
        EntityManagerInterface $em,
        HubInterface $hub,
        UserRepository $userRepo
    ): JsonResponse {
    $data = json_decode($request->getContent(), true);
    /** @var \App\Entity\User $sender */
    $sender = $this->getUser();
    if (!$sender) {
        return $this->json(['error' => 'Not authenticated'], 401);
    }
    $receiver = $userRepo->find($data['receiver_id']);

    $message = new Message();
    $message->setSender($sender);
    $message->setReceiver($receiver);
    $message->setContent($data['content']);
    $message->setCreatedAt(new \DateTimeImmutable());

    $em->persist($message);
    $em->flush();

    $topic = 'http://localhost:8001/chat/private/' . min($sender->getId(), $receiver->getId()) . max($sender->getId(), $receiver->getId());

    $update = new Update(
        $topic,
        json_encode([
            'id' => $message->getId(),
            'sender' => $sender->getId(),
            'receiver' => $receiver->getId(),
            'content' => $message->getContent(),
            'createdAt' => $message->getCreatedAt()->format('c'),
        ])
    );

    $hub->publish($update);
    
    // return $this->json(['status' => 'Message sent']);
    return new JsonResponse([
        'status' => 'Message sent',
        'topic' => $topic,
        'sender' => $sender->getId(),
        'receiver' => $receiver-> getId()
    ]);
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
