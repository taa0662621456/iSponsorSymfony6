<?php

namespace App\EventListener;

use App\Entity\Embeddable\ObjectProperty;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Request;

class LastRequestListener
{
    public function __construct(
        private readonly ManagerRegistry $doctrine,
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $entity = $this->getEntityFromRequest($request);

        if ($entity && method_exists($entity, 'getObjectProperty')) {
            $property = $entity->getObjectProperty();

            if ($property instanceof ObjectProperty) {
                $property->markLastRequestNow();

                $em = $this->doctrine->getManagerForClass($entity::class);
                $em->persist($entity);
                $em->flush();
            }
        }
    }

    private function getEntityFromRequest(Request $request): ?object
    {
        foreach ($request->attributes->all() as $attr) {
            if (is_object($attr) && method_exists($attr, 'getObjectProperty')) {
                return $attr;
            }
        }

        return null;
    }
}