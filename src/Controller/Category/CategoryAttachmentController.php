<?php


namespace App\Controller\Category;

use App\Entity\Category\CategoryAttachment;
use App\Form\Category\CategoryAttachmentType;
use App\Service\AttachmentManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class CategoriesAttachmentsController
 *
 * @package App\Controller\Category
 */
#[Route(path: 'categories/attachments')]
class CategoryAttachmentController extends AbstractController
{
    public function __construct(private readonly AttachmentManager $attachmentsManager, private readonly ManagerRegistry $managerRegistry, private readonly RequestStack $requestStack)
    {
    }
    /**
     * @param null $name
     * @param int|null $id
     * @param string|null $slug
     * @param int|null $createdBy
     * @param string|null $fileLang
     *
     */
    #[Route(path: '/', name: 'categories_attachments_get', methods: ['GET'])]
    public function getAttachments(AuthorizationCheckerInterface $authChecker, $name = null, int $id = null, string $slug = null, int $createdBy = null, bool $published = true, string $fileLang = null) : Response
    {
        $route = $this->requestStack->getMainRequest()->attributes->get('_route');
        if (false === $authChecker->isGranted('ROLE_ADMIN')){
            $id = null;
            $slug = null;
            $createdBy = null;
            $published = true;
            $fileLayoutPosition = $route;
            $fileClass = null;
            $fileLang = $route;
        }
        $attachments = $this->attachmentsManager->getAttachments(
                $entity = CategoryAttachment::class,
                $id = null,
                $slug = null,
                $createdBy = null,
                $published = true,
                $fileLayoutPosition = $route,
                $fileClass = null,
                $fileLang = $route
            );
        return $this->render(
            'category/category_attachment/' . $route . '_attachments.html.twig',
            [
                'attachments' => $attachments,
            ]
        );
    }
    #[Route(path: '/set', name: 'categories_attachment_set', methods: ['GET', 'POST'])]
    #[Route(path: '/add', name: 'categories_attachment_add', methods: ['GET', 'POST'])]
    #[Route(path: '/new', name: 'categories_attachment_new', methods: ['GET', 'POST'])]
    public function setAttachment(Request $request) : Response
    {
        $attachment = new CategoryAttachment();
        //$this->denyAccessUnlessGranted('create', $attachment);
        $form = $this->createForm(
            CategoryAttachmentType::class,
            $attachment
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry
                                  ->getManager()
            ;
            $entityManager->persist($attachment);
            $entityManager->flush();

            return $this->redirectToRoute('categories_attachments_get');
        }
        return $this->render(
            'vendor/vendor/new.html.twig',
            [
                'attachment' => $attachment,
                'form'       => $form->createView(),
            ]
        );
    }
    #[Route(path: '/{id<\d+>}/show', name: 'categories_attachments_id', methods: ['GET'])]
    #[Route(path: '/{slug}/show', name: 'categories_attachments_slug', methods: ['GET'])]
    public function showAttachment(CategoryAttachment $categoriesAttachments) : Response
    {
        $this->denyAccessUnlessGranted('show', $categoriesAttachments);
        return $this->render(
            'vendor/vendor_attachment/show.html.twig',
            [
                'attachment' => $categoriesAttachments,
            ]
        );
    }

    /**
     *
     *
     * @param Request $request
     * @param CategoryAttachment $categoriesAttachments
     * @param int $id
     * @param string $slug
     *
     * Security("categoriesAttachments.isAuthor(vendor)")
     * Security("has_role('ROLE_ADMIN')
     * @return Response
     */
    #[Route(path: '/{id<\d+>}/edit', name: 'category_attachment_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: '/{slug}/edit', name: 'category_attachment_edit_slug', methods: ['GET', 'POST'])]
    public function editAttachment(Request $request, CategoryAttachment $categoriesAttachments, int $id, string $slug) : Response
    {
        $this->denyAccessUnlessGranted('edit', $categoriesAttachments);
        $form = $this->createForm(
            CategoryAttachmentType::class,
            $categoriesAttachments
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry
                 ->getManager()
                 ->flush()
            ;

            return $this->redirectToRoute('');
        }
        return $this->render(
            'vendor/vendor/edit.html.twig',
            [
                'vendors_attachment' => $categoriesAttachments,
                'form'               => $form->createView(),
            ]
        );
    }

    /**
     *
     *
     * @param Request $request
     * @param CategoryAttachment $categoriesAttachments
     * @param int $id
     * @param string $slug
     *
     * Security("categoriesAttachments.isAuthor(vendor)")
     * Security("has_role('ROLE_ADMIN')
     * @return Response
     */
    #[Route(path: '/{id<\d+>/delete}', name: 'category_attachment_delete_id', methods: ['DELETE'])]
    #[Route(path: '/{slug}/delete', name: 'category_attachment_delete_slug', methods: ['DELETE'])]
    public function deleteAttachment(Request $request, CategoryAttachment $categoriesAttachments, int $id, string $slug) : Response
    {
        $this->denyAccessUnlessGranted('delete', $categoriesAttachments);
        if ($this->isCsrfTokenValid(
            'delete' . $categoriesAttachments->getId(),
            $request->request->get('_token')
        )) {
            $entityManager = $this->managerRegistry
                                  ->getManager()
            ;
            $entityManager->remove($categoriesAttachments);
            $entityManager->flush();
        }
        return $this->redirectToRoute('categories_attachments_get');
    }
}
