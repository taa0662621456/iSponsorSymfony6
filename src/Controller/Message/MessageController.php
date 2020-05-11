<?php


namespace App\Controller\Message;


use App\Entity\Conversation;
use App\Entity\Message\Message;
use App\Repository\Message\ConversationRepository;
use App\Repository\Vendor\VendorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @var MassageRepository
     */
    private $massageRepository;
    /**
     * @var VendorsRepository
     */
    private $vendorsRepository;

    /**
     * MessageController constructor.
     * @param EntityManagerInterface $entityManager
     * @param MassageRepository $massageRepository
     * @param VendorsRepository $vendorsRepository
     */
    public function __construct(EntityManagerInterface $entityManager, MassageRepository $massageRepository, VendorsRepository $vendorsRepository)
    {
        $this->entityManager = $entityManager;
        $this->massageRepository = $massageRepository;
        $this->vendorsRepository = $vendorsRepository;
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
     * @return JsonResponse
     * @throws Exception
     */
    public function newMessage(Request $request, Conversation $conversation)
    {
        $user = $this->getUser();
        $content = $request->get('content', null);

        $message = new Message();
        $message->setContent($content);
        $message->setCreatedBy($this->vendorsRepository->findOneBy(['id' => 1]));
        $message->setMine(true);

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

        return $this->json($message, Response::HTTP_CREATED, [], [
            'attribute' => self::ATTRIBUTES_TO_SERIALIZE
        ]);

    }


}
