<?php

namespace App\Controller\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorMediaAttachment;
use App\Service\AttachmentManager;
use App\Form\Vendor\VendorMediaType;
use App\Entity\Vendor\VendorDocumentAttachment;
use App\Form\Vendor\VendorDocumentType;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class VendorsAttachmentController extends AbstractController
{
    public function __construct(
        private readonly AttachmentManager $attachmentsManager,
        private readonly ManagerRegistry $managerRegistry
    ) {
    }

    /**
     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление.
     */
    #[Route(path: '/', name: 'vendor_get_attachments', methods: ['GET'])]
    public function getAttachments(Request $request, string $entity = VendorMediaAttachment::class, string $layout = 'index'): Response
    {
        /*
         * если роль Админ и выше, параметр $createdBy принимается из запроса,
         * в противном случе = $this->getUser()
         *
         */
        if ('profile' == $request->get('_route')) {            // TODO: need add role by ROLE_ADMIN; maybe PHP Switch
            $createdBy = null;                                 // Vendor is null for template Security
            $published = true;                                 // ...for marketing security
            $fileLayoutPosition = $request->get('_route');     // ... for filtering
            $fileLang = $request->get('app_locale') ?: '*';       // ... for different
        }
        $attachments = $this->attachmentsManager->getAttachments(
            $entity = VendorMediaAttachment::class,
            $id = null,
            $slug = null,
            $createdBy = null, // Important! Must by User object
            $published = true,
            $fileLayoutPosition = null,
            $fileClass = null,
            $fileLang = null
        );

        return $this->render(
            'vendor/vendors_attachments/'.$layout.'.html.twig',
            [
                'attachments' => $attachments,
            ]
        );
    }

    /**
     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление.
     *
     * @throws Exception
     */
    #[Route(path: '/set', name: 'vendor_set_attachment', methods: ['GET', 'POST'])]
    public function setAttachment(Request $request): Response
    {
        $vendor = new Vendor();
        $form = $this->createForm(VendorMediaType::class, $vendor);
        if ('media' !== $request->request->get('_route')) {
            $form = $this->createForm(VendorDocumentType::class, $vendor);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry
                                  ->getManager();
            $entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('category_attachment_edit_slug');
        }

        return $this->render(
            'vendor/vendors/new.html.twig',
            [
                'vendors' => $vendor,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * добавить ограничите по тем ИД, которые пренадлежать вендору (его собственные медиа, его собственные медия
     * документов).
     */
    #[Route(path: '/{id<\d+>}', name: 'vendor_attachment_show_id', methods: ['GET'])]
    public function show(VendorMediaAttachment $vendorsMediaAttachments, VendorDocumentAttachment $vendorsDocumentAttachments): Response
    {
        // TODO: необходимо ветвление
        return $this->render(
            'vendor/vendors_attachments/show.html.twig',
            [
                'vendors_attachment' => $vendorsMediaAttachments,
            ]
        );
    }

    #[Route(path: '/{slug}/edit', name: 'doc_edit', methods: ['GET', 'POST'])]
    #[Route(path: '/{id<\d+>}/edit', name: 'doc_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VendorMediaAttachment $vendorsMediaAttachments, VendorDocumentAttachment $vendorsDocumentAttachments): Response
    {
        $form = $this->createForm(VendorMediaType::class, $vendorsMediaAttachments);
        if ('media' !== $request->request->get('_route')) {
            $form = $this->createForm(VendorDocumentType::class, $vendorsDocumentAttachments);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry
                 ->getManager()
                 ->flush();

            return $this->redirectToRoute('category_attachment_edit_slug');
        }

        return $this->render(        // TODO: необходимо ветвление между документами и простым медиа
            'vendor/vendors/edit.html.twig',
            [
                'vendors_attachment' => $vendorsMediaAttachments,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{slug}', name: 'vendors_delete_slug', methods: ['DELETE'])]
    #[Route(path: '/{id<\d+>}', name: 'vendors_delete_id', methods: ['DELETE'])]
    public function delete(Request $request, VendorMediaAttachment $vendorsMediaAttachments, VendorDocumentAttachment $VendorsDocumentAttachmentsType): Response
    {
        // TODO: необходимо ветвление между документами и обычным медиа
        if ($this->isCsrfTokenValid(
            'delete'.$vendorsMediaAttachments->getId(),
            $request->request->get('_token')
        )) {
            $entityManager = $this->managerRegistry
                                  ->getManager();
            $entityManager->remove($vendorsMediaAttachments);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_attachments_get');
    }
}
