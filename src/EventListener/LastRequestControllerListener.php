<?php

namespace App\EventListener;

use App\Entity\Embeddable\ObjectProperty;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Security\Core\Security;

class LastRequestControllerListener
{
    public function __construct(
        private readonly ManagerRegistry $doctrine,
        private readonly LoggerInterface $logger,
        private readonly Security $security
    ) {}

    public function onKernelController(ControllerEvent $event): void
    {
        $request = $event->getRequest();
        $entityOrEntities = $request->attributes->get('entityObject');

        if (!$entityOrEntities) {
            return;

        }

        if (is_array($entityOrEntities)) {
            foreach ($entityOrEntities as $entity) {
                $this->updateLastRequest($entity);
            }
        } else {
            $this->updateLastRequest($entityOrEntities);
        }
    }

    private function updateLastRequest(object $entity): void
    {
        if (!method_exists($entity, 'getObjectProperty')) {
            return;
        }

        $property = $entity->getObjectProperty();

        if ($property instanceof ObjectProperty) {
            $property->markLastRequestNow();

            $em = $this->doctrine->getManagerForClass($entity::class);
            $em->persist($entity);
            $em->flush();

            // Получаем текущего пользователя
            $user = $this->security->getUser();
            $userContext = null;
            if ($user) {
                $userContext = [
                    'id'       => method_exists($user, 'getId') ? $user->getId() : null,
                    'username' => method_exists($user, 'getUserIdentifier')
                        ? $user->getUserIdentifier()
                        : (method_exists($user, 'getUsername') ? $user->getUsername() : null),
                ];
            }

            $this->logger->info('lastRequestDate updated', [
                'entity_class' => $entity::class,
                'entity_id'    => method_exists($entity, 'getId') ? $entity->getId() : null,
                'new_date'     => $property->getLastRequestDate()?->format('Y-m-d H:i:s'),
                'user'         => $userContext,
            ]);
        }
    }
}
