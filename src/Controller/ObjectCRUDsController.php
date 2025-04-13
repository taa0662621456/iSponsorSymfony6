<?php

namespace App\Controller;

use App\Service\ObjectInitializer;
use JetBrains\PhpStorm\NoReturn;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
#[Route('/{entity}/{subEntity}', defaults: ['subEntity' => null])]
class ObjectCRUDsController extends AbstractController
{
    #[NoReturn]
    public function __construct(
        private readonly ObjectInitializer $objectInitializer,
        private readonly ManagerRegistry   $managerRegistry
    )
    {
    }

    #[Route(name: '_index', methods: ['GET'])]
    public function index(): Response
    {
        $entityClass = $this->objectInitializer->getObjectEntityClass();

        $repository = $this->managerRegistry->getRepository($entityClass);

        $user = $this->getUser();
        $objects = $user
            ? $repository->findAll()
            : $repository->findBy(['createdBy' => $this->getUser()]);

        return $this->render($this->objectInitializer->getObjectTemplatePath(), [
            $this->objectInitializer->getObjectRoutPath() => $objects,
        ]);
    }

    #[Route(path: '/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $entityClass = $this->objectInitializer->getObjectEntityClass();
        $object = new $entityClass();

        $attachmentClass = $this->objectInitializer->getObjectAttachmentNamespace();
        $attachment = $attachmentClass ? new $attachmentClass() : null;

        return $this->handleForm($request, $object, $attachment);
    }

    // Show
    #[Route(path: '/{id<\d+>}', name: '_show_id', methods: ['GET'])]
    #[Route(path: '/{slug}', name: '_show_slug', methods: ['GET'])]
    public function show(?int $id = null, ?string $slug = null): Response
    {
        $entity = $this->objectInitializer->getObject($id, $slug);

        if (!$entity) {
            throw $this->createNotFoundException('Object not found');
        }

        return $this->render($this->objectInitializer->getObjectTemplatePath(), [
            $this->objectInitializer->getObjectRoutPath() => $entity,
        ]);
    }

    // Edit
    #[Route('/edit/{id<\d+>}', name: '_edit_id', methods: ['GET', 'POST'])]
    #[Route('/edit/{slug}', name: '_edit_slug', methods: ['GET', 'POST'])]
    public function edit(Request $request, ?int $id = null, ?string $slug = null): Response
    {
        $object = $this->objectInitializer->getObject($id, $slug);

        if (!$object) {
            throw $this->createNotFoundException('Object not found');
        }

        return $this->handleForm($request, $object);
    }
    // Delete
    #[Route(path: '/delete/{id<\d+>}', name: '_delete_id', methods: ['DELETE'])]
    #[Route(path: '/delete/{slug}', name: '_delete_slug', methods: ['DELETE'])]
    public function delete(Request $request, int $id = null, string $slug = null): Response
    {
        $object = $this->objectInitializer->getObject($id, $slug);

        if ($this->isCsrfTokenValid('delete' . $object->getId(), $request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token. Token validation failed');

        }

        $entityManager = $this->managerRegistry->getManager();
        $entityManager->remove($object);
        $entityManager->flush();

        $this->addFlash('notice', 'Successfully deleted!');

        return $this->redirectToRoute($this->objectInitializer->getObjectRoutPath() . '_index');
    }

    #[Route(path: '/own', name: '_own', methods: ['GET'])]
    public function own(): Response
    {
        $localeFilter = $this->objectInitializer->getLocaleFilter();
        ($localeFilter) ? $object = $this->objectInitializer->getLocaleFilter() : $object = $this->objectInitializer->getObjectNamespace();
        $em = $this->managerRegistry->getManager();

        return $this->render($this->objectInitializer->getObjectTemplatePath(), [
            $this->objectInitializer->getObjectRoutPath() => $em->getRepository($object)->findBy(['createdBy' => $this->getUser()]),
        ]);
    }

    #[Route(path: '/thanks', name: '_thanks', methods: ['GET'])]
    public function thankYou()
    {
    }

//    /**
//     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление
//     * @Route("/", name="vendor_get_attachments", methods={"GET"})
//     * @param Request     $request
//     * @param string|null $entity
//     * @param string|null $layout
//     *
//     * @return Response
//     */
//    public function getAttachments(Request $request,
//                                   string $entity = 'App\Entity\Vendor\VendorMedia',
//                                   string $layout = 'index'): Response
//    {
//        /**
//         * если роль Админ и выше, параметр $createdBy принимается из запроса,
//         * в противном случе = $this->getUser()
//         *
//         */
//
//        if ($request->get('_route') == 'profile') {            //TODO: need add role by ROLE_ADMIN; maybe PHP Switch
//            $createdBy = null;                                 // Vendor is null for template Security
//            $published = true;                                 // ...for marketing security
//            $fileLayoutPosition = $request->get('_route');     // ... for filtering
//            $fileLang = $request->get('app_locale') ?: '*';       // ... for different
//        }
//
//        $attachments = $this->attachmentsManager->getAttachments(
//            $entity = 'App\Entity\Vendor\VendorMedia',
//            $id = null,
//            $slug = null,
//            $createdBy = null, //Important! Must by User object
//            $published = true,
//            $fileLayoutPosition = null,
//            $fileClass = null,
//            $fileLang = null
//        );
//
//    }
//
//
    #[Route(path: '/summery/', name: '_summery', methods: ['GET', 'POST'])]
    public function summery()
    {
    }

    #[Route(path: '/widget/', name: '_widget', methods: ['GET', 'POST'])]
    public function widget()
    {
    }

    private function handleForm(Request $request, object $object, ?object $attachment = null): ?Response
    {
        $form = $this->createForm($this->objectInitializer->getObjectTypeNamespace(), $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->managerRegistry->getManager();
            $em->persist($object);

            if ($attachment) {
                if (method_exists($attachment, 'setParent')) {
                    $attachment->setParent($object);
                }
                $em->persist($attachment);
            }

            $em->flush();

            $route = $form->get('submitAndNew')?->isClicked()
                ? $this->objectInitializer->getObjectRoutPath() . '_new'
                : $this->objectInitializer->getObjectRoutPath() . '_index';

            return $this->redirectToRoute($route);
        }

        return $this->render($this->objectInitializer->getObjectTemplatePath(), [
            $this->objectInitializer->getObjectRoutPath() => $object,
            'form' => $form->createView(),
        ]);
    }

}

