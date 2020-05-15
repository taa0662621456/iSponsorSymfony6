<?php

namespace App\Controller\Message;

use App\Entity\Message\Conversation;
use App\Entity\Message\Message;
use App\Repository\Message\ParticipantRepository;
use App\Repository\Vendor\VendorsRepository;
use App\Repository\Message\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class MessageController
 * @package App\Controller\Message
 * @Route("/messages", name="messages.")
 */
class MessageController extends AbstractController
{
    const ATTRIBUTES_TO_SERIALIZE = ['id', 'content', 'createdBy', 'mine'];

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MessageRepository
     */
    private $massageRepository;
    /**
     * @var VendorsRepository
     */
    private $vendorsRepository;
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * MessageController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageRepository $massageRepository
     * @param VendorsRepository $vendorsRepository
     * @param ParticipantRepository $participantRepository
     * @param PublisherInterface $publisher
     */
    public function __construct(EntityManagerInterface $entityManager,
                                MessageRepository $massageRepository,
                                VendorsRepository $vendorsRepository,
                                ParticipantRepository $participantRepository,
                                PublisherInterface $publisher)
    {
        $this->entityManager = $entityManager;
        $this->massageRepository = $massageRepository;
        $this->vendorsRepository = $vendorsRepository;
        $this->participantRepository = $participantRepository;
        $this->publisher = $publisher;
    }

    /**
     * @Route("/{id}", name="getMessage")
     * @param Request $request
     * @param Conversation $conversation
     * @return Response
     */
    public function index(Request $request, Conversation $conversation)
    {
        $this->denyAccessUnlessGranted('view', $conversation);
        $messages = $this->massageRepository->findMessageByConversationId(
            $conversation->getId()
        );

        array_map(function ($message) {
            $message->setMine(
                $message->getUser()->getId() === $this->getUser()->getId()
                    ? true : false
            );
        }, $messages);

        return $this->json($messages, Response::HTTP_OK, [], [
            'attribute' => self::ATTRIBUTES_TO_SERIALIZE
        ]);
    }

    /**
     * @Route("/{id}", name="newMessage", methods={"POST"})
     * @param Request $request
     * @param Conversation $conversation
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @throws Exception
     */
    public function newMessage(Request $request, Conversation $conversation, SerializerInterface $serializer)
    {
        $user = $this->getUser();

        $recipient = $this->participantRepository->findParticipantByConversationIdAndUserId(
            $conversation->getId(),
            $user->getId()
        );

        $user = $this->vendorsRepository->findOneBy(['id' => 2]);
        $content = $request->get('content', null);

        $message = new Message();
        $message->setContent($content);
        $message->setCreatedBy($user);

        $conversation->addMessage($message);
        $conversation->setLastMessage($message);

        $this->entityManager->getConnection()->beginTransaction();
        try {
            $this->entityManager->persist($message);
            $this->entityManager->persist($conversation);
            $this->entityManager->flush();

            $this->entityManager->commit();

        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }

        $message->setMine(false);
        $messageSerialized = $serializer->serialize($message, 'json', [
            'attributes' => ['id', 'content', 'createdBy', 'mine', 'conversation' => ['id']]
        ]);

        $update = new Update(
            [
                sprintf("/conversation/%s", $conversation->getId()),
                sprintf("/conversation/%s", $recipient->getUser()->getUsername())
            ],
            $messageSerialized,
            [
                sprintf("/%s", $recipient->getUser()->getUsername())
            ]
        );

        $this->publisher->__invoke($update);

        $message->setMine(true);

        return $this->json($message, Response::HTTP_CREATED, [], [
            'attribute' => self::ATTRIBUTES_TO_SERIALIZE
        ]);

    }


}
