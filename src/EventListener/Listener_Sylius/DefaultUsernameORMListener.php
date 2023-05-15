<?php


namespace App\EventListener\Listener_Sylius;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\UnitOfWork;


use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

/**
 * Keeps user's username synchronized with email.
 */
final class DefaultUsernameORMListener
{
    public function onFlush(OnFlushEventArgs $onFlushEventArgs): void
    {
        $entityManager = $onFlushEventArgs->getObjectManager();
        $unitOfWork = $entityManager->getUnitOfWork();

        $this->processEntities($unitOfWork->getScheduledEntityInsertions(), $entityManager, $unitOfWork);
        $this->processEntities($unitOfWork->getScheduledEntityUpdates(), $entityManager, $unitOfWork);
    }

    private function processEntities(array $entities, EntityManagerInterface $entityManager, UnitOfWork $unitOfWork): void
    {
        foreach ($entities as $entity) {
            if (!$entity instanceof ShopUserInterface && !$entity instanceof CustomerInterface) {
                continue;
            }

            if ($entity instanceof ShopUserInterface) {
                $user = $entity;
                $customer = $user->getCustomer();
            } else {
                $customer = $entity;
                $user = $customer->getUser();
            }

            if (!$customer || !$user) {
                continue;
            }

            if (!method_exists($user, 'getUsername')) {
                continue;
            }
            if ($customer->getEmail() === $user->getUsername() && $customer->getEmailCanonical() === $user->getUsernameCanonical()) {
                continue;
            }

            $user->setUsername($customer->getEmail());
            $user->setUsernameCanonical($customer->getEmailCanonical());

            /** @var ClassMetadata $userMetadata */
            $userMetadata = $entityManager->getClassMetadata($user::class);
            $unitOfWork->recomputeSingleEntityChangeSet($userMetadata, $user);
        }
    }
}
