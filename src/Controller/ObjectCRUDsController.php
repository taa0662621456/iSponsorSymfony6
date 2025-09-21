<?php

namespace App\Controller;

use App\Service\Entity\EntityOrchestrator;
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
    public function __construct(
        private readonly EntityOrchestrator $entityOrchestrator,
        private readonly ManagerRegistry $managerRegistry,
    ) {}

    #[Route(name: '_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $repository = $this->managerRegistry->getRepository(
            $this->entityOrchestrator->getEntityClassName()
        );

        $user = $this->getUser();
        $objects = $user
            ? $repository->findBy(['createdBy' => $user])
            : $repository->findAll();

        return $this->render($this->entityOrchestrator->getEntityTemplatePath(), [
            $this->entityOrchestrator->getEntityRoutPath() => $objects,
        ]);
    }

    #[Route(path: '/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $className = $this->entityOrchestrator->getEntityClassName();
        $object = new $className();

        $attachmentClass = $this->entityOrchestrator->getEntityAttachmentClass();
        $attachment = $attachmentClass ? new $attachmentClass() : null;

        // 👉 Передаём новый объект в Request
        $request->attributes->set('entityObject', $object);

        return $this->handleForm($request, $object, $attachment);
    }

    #[Route(path: '/{id<\d+>}', name: '_show_id', methods: ['GET'])]
    #[Route(path: '/{slug}', name: '_show_slug', methods: ['GET'])]
    public function show(Request $request, ?int $id = null, ?string $slug = null): Response
    {
        $entity = $this->entityOrchestrator->getEntityObject($id, $slug);

        if (!$entity) {
            throw $this->createNotFoundException('Object not found');
        }

        // 👉 Передаём объект в Request
        $request->attributes->set('entityObject', $entity);

        return $this->render($this->entityOrchestrator->getEntityTemplatePath(), [
            $this->entityOrchestrator->getEntityRoutPath() => $entity,
        ]);
    }

    #[Route('/edit/{id<\d+>}', name: '_edit_id', methods: ['GET', 'POST'])]
    #[Route('/edit/{slug}', name: '_edit_slug', methods: ['GET', 'POST'])]
    public function edit(Request $request, ?int $id = null, ?string $slug = null): Response
    {
        $object = $this->entityOrchestrator->getEntityObject($id, $slug);

        if (!$object) {
            throw $this->createNotFoundException('Object not found');
        }

        // 👉 Передаём объект в Request
        $request->attributes->set('entityObject', $object);

        return $this->handleForm($request, $object);
    }

    #[Route(path: '/delete/{id<\d+>}', name: '_delete_id', methods: ['DELETE'])]
    #[Route(path: '/delete/{slug}', name: '_delete_slug', methods: ['DELETE'])]
    public function delete(Request $request, int $id = null, string $slug = null): Response
    {
        $object = $this->entityOrchestrator->getEntityObject($id, $slug);

        if (!$object) {
            throw $this->createNotFoundException('Object not found');
        }

        // 👉 Передаём объект в Request
        $request->attributes->set('entityObject', $object);

        if (!$this->isCsrfTokenValid('delete' . $object->getId(), $request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $em = $this->managerRegistry->getManager();
        $em->remove($object);
        $em->flush();

        $this->addFlash('notice', 'Successfully deleted!');

        return $this->redirectToRoute($this->entityOrchestrator->getEntityRoutPath() . '_index');
    }

    #[Route(path: '/own', name: '_own', methods: ['GET'])]
    public function own(Request $request): Response
    {
        $em = $this->managerRegistry->getManager();

        $objects = $em->getRepository($this->entityOrchestrator->getEntityNamespace())
            ->findBy(['createdBy' => $this->getUser()]);

        // 👉 Пробросим массив объектов в Request (listener может зафиксировать массовый доступ)
        $request->attributes->set('entityObject', $objects);

        return $this->render($this->entityOrchestrator->getEntityTemplatePath(), [
            $this->entityOrchestrator->getEntityRoutPath() => $objects,
        ]);
    }

    #[Route(path: '/thanks', name: '_thanks', methods: ['GET'])]
    public function thankYou(): Response
    {
        return new Response('Thank you!');
    }

    #[Route(path: '/summery/', name: '_summery', methods: ['GET', 'POST'])]
    public function summery(): Response
    {
        return new Response('Summery page');
    }

    #[Route(path: '/widget/', name: '_widget', methods: ['GET', 'POST'])]
    public function widget(): Response
    {
        return new Response('Widget page');
    }

    private function handleForm(Request $request, object $object, ?object $attachment = null): ?Response
    {
        $form = $this->createForm($this->entityOrchestrator->getObjectTypeNamespace(), $object);
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
                ? $this->entityOrchestrator->getEntityRoutPath() . '_new'
                : $this->entityOrchestrator->getEntityRoutPath() . '_index';

            return $this->redirectToRoute($route);
        }

        return $this->render($this->entityOrchestrator->getObjectTemplatePath(), [
            $this->entityOrchestrator->getEntityRoutPath() => $object,
            'form' => $form->createView(),
        ]);
    }
}
