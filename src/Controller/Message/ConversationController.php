<?php

namespace App\Controller\Message;

use App\Entity\Message\MessageParticipant;
use App\Repository\Message\MessageConversationRepository;
use App\Repository\Vendor\VendorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Fig\Link\Link;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConversationController
 * @package App\Controller\Message
 * @Route("conversations", name="conversations.")
 */
class ConversationController extends AbstractController
{
    /**
     * @var VendorsRepository
     */
    private VendorsRepository $vendorsRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var MessageConversationRepository
     */
    private MessageConversationRepository $conversationRepository;

    /**
     * ConversationController constructor.
     * @param VendorsRepository $vendorsRepository
     * @param EntityManagerInterface $entityManager
     * @param MessageConversationRepository $conversationRepository
     */
    public function __construct(VendorsRepository $vendorsRepository,
                                EntityManagerInterface $entityManager,
                                MessageConversationRepository $conversationRepository)
    {
        $this->vendorsRepository = $vendorsRepository;
        $this->entityManager = $entityManager;
        $this->conversationRepository = $conversationRepository;
    }

    /**
     * @Route("/", name="newConversations", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        $otherUser = $request->get('otherUser', 0);
        $otherUser = $this->vendorsRepository->find($otherUser);

        if (is_null($otherUser)) {
            throw new Exception("The User ws not found");
        }

        // cannot create a conversation with myself
        if ($otherUser->getId() === $this->getUser()->getId()) {
            throw new Exception("That's deep but you cannot create a conversation with myself");
        }

        // Check if conversation already exists
        $conversation = $this->conversationRepository->findConversationByParticipants(
            $otherUser->getId(),
            $this->getUser() - $this->getId()
        );

        if (count($conversation)) {
            throw new Exception("The conversation already exists");
        }

        $conversation = new Conversation();

        $participant = new MessageParticipant();
        $participant->setUser($this->getUser());
        $participant->setConvarsation($conversation);

        $otherParticipant = new MessageParticipant();
        $otherParticipant->setUser($otherUser);
        $otherParticipant->setConvarsation($conversation);

        $this->entityManager->getConnection()->beginTransaction();
        try {

            $this->entityManager->persist($conversation);
            $this->entityManager->persist($participant);
            $this->entityManager->persist($otherParticipant);

            $this->entityManager->flush();

        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
        $this->entityManager->commit();

        return $this->json([
            'id' => $conversation->getId()
        ], Response::HTTP_CREATED, [], []);
    }

    /**
     * @Route("/", name="getConversations", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getConversations(Request $request): JsonResponse
    {
        $conversations = $this->conversationRepository->findConversationByUser($this->getUser()->getId());

        $hubUrl = $this->getParameter('mercure.default_hub');

        $this->addLink($request, new Link('mercure', $hubUrl));


        return $this->json($conversations);


    }


}
