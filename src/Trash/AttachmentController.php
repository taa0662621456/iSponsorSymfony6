<?php


namespace App;


use App\Form\Category\CategoriesAttachmentsType;
use App\Service\AttachmentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AttachmentController extends AbstractController
{
    /**
     * @var AttachmentManager
     */
    private $attachmentsManager;
    /**
     * @var EntityManagerInterface
     */
    private $entity;
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authChecker;
    /**
     * @var Request
     */
    private $request;

    public function __construct(AttachmentManager $attachmentsManager,
                                AuthorizationCheckerInterface $authChecker,
                                EntityManagerInterface $entity,
                                RequestStack $requestStack,
                                Request $request)
    {
        $this->attachmentsManager = $attachmentsManager;
        $this->authChecker = $authChecker;
        $this->entity = $entity;
        $this->requestStack = $requestStack;
        $this->request = $request;
    }

    /**
     * @Route("/", name="categories_attachments_get", methods={"GET"})
     * @Route("/", name="vendor_get_attachments", methods={"GET"})
     * @param null $name
     * @param int|null $id
     * @param string|null $slug
     * @param int|null $createdBy
     * @param bool|true $published
     * @param string|null $fileLang
     *
     * @return Response
     */
    public function getAttachments($name = null,
                                   int $id = null,
                                   string $slug = null,
                                   int $createdBy = null,
                                   bool $published = true,
                                   string $fileLang = null): Response
    {
        $route = $this->requestStack->getMasterRequest()->attributes->get('_route');

        if (false === $this->authChecker->isGranted('ROLE_ADMIN')){
            $id = null;
            $slug = null;
            $createdBy = null;
            $published = true;
            $fileLayoutPosition = $route;
            $fileClass = null;
            $fileLang = $this->request->get('_locale') ?: '*';
        }
        $attachments = $this->attachmentsManager->getAttachments(
            $entity = 'App\Entity\\' . $route. '\\' . $route . 'Attachments',
            $id = null,
            $slug = null,
            $createdBy = null,
            $published = true,
            $fileLayoutPosition = $route,
            $fileClass = null,
            $fileLang = $this->request->get('_locale') ?: '*'
        );

        return $this->render(
            $route . '/' . $route . '_attachments/' . $route . '_attachments.html.twig',
            array(
                'attachments' => $attachments,
            )
        );
    }


    /**
     * @ Route("/set", name="categories_attachment_set", methods={"GET","POST"})
     * @ Route("/add", name="categories_attachment_add", methods={"GET","POST"})
     * @ Route("/new", name="categories_attachment_new", methods={"GET","POST"})
     *
     * @ Route("/set", name="vendor_attachment"_set, methods={"GET","POST"})
     * @ Route("/add", name="vendor_attachment_add", methods={"GET","POST"})
     * @ Route("/new", name="vendor_attachment_new", methods={"GET","POST"})
     *
     * @return Response
     */
    public function setAttachment(): Response
    {
        $route = explode('_', $this->requestStack->getMasterRequest()->attributes->get('_route'), 3);
        $object = $route[0]. 'Attachments';
        $type =  $route[0]. 'AttachmentsType'; // нужно передать полный путь... от Апп
        $attachment = new $object();

        //$form = $this->createForm(CategoriesAttachmentsType::class),
        $form = $this->createForm($type,
            $attachment
        );
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()
                ->getManager()
            ;
            $entityManager->persist($attachment);
            $entityManager->flush();

            return $this->redirectToRoute($route .'_attachments_get');
        }

        return $this->render(
            $route .'/' . $route .'/new.html.twig',
            [
                'attachment' => $attachment,
                'form'       => $form->createView(),
            ]
        );
    }
}
