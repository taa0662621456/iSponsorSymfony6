<?php

namespace App\Controller\Vendor;


use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorMedia;
use App\Form\Vendor\VendorDocumentType;
use App\Form\Vendor\VendorMediaType;
use App\Service\AttachmentManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsController]
class VendorsAttachmentController extends AbstractController
{
    public function __construct(
        private readonly AttachmentManager      $attachmentsManager,
        private readonly ManagerRegistry        $managerRegistry,
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface        $logger,
        private readonly SluggerInterface $slugger
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/upload', name: 'upload', methods: ['POST'])]
    public function upload(Request $request): Response
    {
        $this->assertCsrf('vendor_upload', $request->request->get('_token'));

        /** @var UploadedFile|null $file */
        $file = $request->files->get('file');
        if (!$file) {
            $this->addFlash('danger', 'Файл не получен');
            return $this->redirectToRoute('vendor_dashboard');
        }

        // базовые проверки
        if ($file->getSize() > 20 * 1024 * 1024) { // 20MB
            $this->addFlash('danger', 'Файл слишком большой');
            return $this->redirectToRoute('vendor_dashboard');
        }

        $allowed = ['image/jpeg','image/png','application/pdf'];
        $mime = (new MimeTypes())->guessMimeType($file->getPathname()) ?? $file->getMimeType();
        if (!\in_array($mime, $allowed, true)) {
            $this->addFlash('danger', 'Недопустимый тип файла');
            return $this->redirectToRoute('vendor_dashboard');
        }

        $safeName = $this->slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $newFilename = $safeName.'-'.bin2hex(random_bytes(6)).'.'.$file->guessExtension();

        try {
            $file->move($this->getParameter('upload_vendor_dir'), $newFilename);

            $entity = \str_starts_with($mime, 'image/')
                ? (new VendorMedia())->setPath($newFilename)->setMimeType($mime)->setVendor($this->getUser()->getVendor())
                : (new VendorDocument())->setPath($newFilename)->setMimeType($mime)->setVendor($this->getUser()->getVendor());

            $this->em->persist($entity);
            $this->em->flush();

            $this->logger->info('Vendor file uploaded', ['vendor' => $this->getUser()->getUserIdentifier(), 'file' => $newFilename, 'mime' => $mime]);
            $this->addFlash('success', 'Файл загружен');
        } catch (FileException|\Throwable $e) {
            $this->logger->error('Upload failed', ['e' => $e]);
            $this->addFlash('danger', 'Ошибка загрузки файла');
        }

        return $this->redirectToRoute('vendor_dashboard');
    }

    private function assertCsrf(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
    }

    /**
     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление
     * @param Request $request
     * @param string $entity
     * @param string $layout
     * @return Response
     */
    #[Route(path: '/', name: 'vendor_get_attachments', methods: ['GET'])]
    public function getAttachments(Request $request, string $entity = VendorMedia::class, string $layout = 'index') : Response
    {
        /**
         * если роль Админ и выше, параметр $createdBy принимается из запроса,
         * в противном случе = $this->getUser()
         *
         */
        if ($request->get('_route') == 'profile') {            //TODO: need add role by ROLE_ADMIN; maybe PHP Switch
            $createdBy = null;                                 // Vendor is null for template Security
            $published = true;                                 // ...for marketing security
            $fileLayoutPosition = $request->get('_route');     // ... for filtering
            $fileLang = $request->get('app_locale') ?: '*';       // ... for different
        }
        $attachments = $this->attachmentsManager->getAttachments(
            $entity = VendorMedia::class,
            $id = null,
            $slug = null,
            $createdBy = null, //Important! Must by User object
            $published = true,
            $fileLayoutPosition = null,
            $fileClass = null,
            $fileLang = null
        );
        return $this->render(
            'vendor/vendors_attachments/' . $layout . '.html.twig',
            [
                'attachments' => $attachments,
            ]
        );
    }

    /**
     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление
     *
     * @throws Exception
     *
     */
    #[Route(path: '/set', name: 'vendor_set_attachment', methods: ['GET', 'POST'])]
    public function setAttachment(Request $request) : Response
    {
        $vendor = new Vendor();
        $form = $this->createForm(VendorMediaType::class, $vendor);
        if ($request->request->get('_route') !== 'media')
            $form = $this->createForm(VendorDocumentType::class, $vendor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry
                                  ->getManager()
            ;
            $entityManager->persist($vendor);
            $entityManager->flush();

            return $this->redirectToRoute('category_attachment_edit_slug');
        }
        return $this->render(
            'vendor/vendors/new.html.twig',
            [
                'vendors' => $vendor,
                'form'    => $form->createView(),
            ]
        );
    }

    /**
     *
     *
     * добавить ограничите по тем ИД, которые пренадлежать вендору (его собственные медиа, его собственные медия
     * документов)
     */
    #[Route(path: '/{id<\d+>}', name: 'vendor_attachment_show_id', methods: ['GET'])]
    public function show(VendorMedia $vendorsMediaAttachments, VendorDocument $vendorsDocumentAttachments) : Response
    {
        //TODO: необходимо ветвление
        return $this->render(
            'vendor/vendors_attachments/show.html.twig',
            [
                'vendors_attachment' => $vendorsMediaAttachments,
            ]
        );
    }

    #[Route(path: '/{slug}/edit', name: 'doc_edit', methods: ['GET', 'POST'])]
    #[Route(path: '/{id<\d+>}/edit', name: 'doc_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VendorMedia $vendorsMediaAttachments, VendorDocument $vendorsDocumentAttachments) : Response
    {
        $form = $this->createForm(VendorMediaType::class, $vendorsMediaAttachments);
        if ($request->request->get('_route') !== 'media')
            $form = $this->createForm(VendorDocumentType::class, $vendorsDocumentAttachments);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry
                 ->getManager()
                 ->flush()
            ;

            return $this->redirectToRoute('category_attachment_edit_slug');
        }
        return $this->render(        //TODO: необходимо ветвление между документами и простым медиа
            'vendor/vendors/edit.html.twig',
            [
                'vendors_attachment' => $vendorsMediaAttachments,
                'form'               => $form->createView(),
            ]
        );
    }


    #[Route(path: '/{slug}', name: 'vendors_delete_slug', methods: ['DELETE'])]
    #[Route(path: '/{id<\d+>}', name: 'vendors_delete_id', methods: ['DELETE'])]
    public function delete(Request $request, VendorMedia $vendorsMediaAttachments, VendorDocument $VendorsDocumentAttachmentsType) : Response
    {
        //TODO: необходимо ветвление между документами и обычным медиа
        if ($this->isCsrfTokenValid(
            'delete' . $vendorsMediaAttachments->getId(), $request->request->get('_token')
        )) {
            $entityManager = $this->managerRegistry
                                  ->getManager()
            ;
            $entityManager->remove($vendorsMediaAttachments);
            $entityManager->flush();
        }
        return $this->redirectToRoute('categories_attachments_get');
    }
}
