<?php

namespace App\EventListener;

use App\Service\Entity\EntityOrchestrator;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function __construct(
        private readonly EntityOrchestrator $entityOrchestrator) {
    }
    public function onKernelRequest(RequestEvent $event): string
    {
        if (!$event->isMainRequest()) {
            return '// ничего не делайте, если это не основной запрос';
        }

        return '// что-то делайте, если это не основной запрос';
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $request = $event->getRequest();

        $entityClassName = $this->entityOrchestrator->getEntityClassName();
        $entityRoutPath = $this->entityOrchestrator->getEntityRoutPath();
        $entityActionName = $this->entityOrchestrator->getEntityActionName();

        $request->attributes->set('_entityNamespace', $this->entityOrchestrator->getEntityNamespace());
        $request->attributes->set('_entityClassName', $this->entityOrchestrator->getEntityClassName());
        $request->attributes->set('_entityRoutPath', $this->entityOrchestrator->getEntityRoutPath());
        $request->attributes->set('_entityRepositoryNamespace', $this->entityOrchestrator->getEntityRepositoryNamespace());
        $request->attributes->set('_entityAttachmentClass', $this->entityOrchestrator->getEntityAttachmentClass($entityClassName));
        $request->attributes->set('_entityActionName', $this->entityOrchestrator->getEntityAttachmentClass($entityClassName));
        $request->attributes->set('_entityTemplatePath', $this->entityOrchestrator->getEntityTemplatePath($entityRoutPath, $entityActionName));
        $request->attributes->set('_entityLocalisedNamespace', $this->entityOrchestrator->getEntityLocalisedNamespace());
        $request->attributes->set('_entityRepositoryNamespace', $this->entityOrchestrator->getEntityRepositoryNamespace());
    }
}
