<?php

namespace App\Service;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class AssociationHydrate
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /** @var ClassMetadata */
    private ClassMetadata $classMetadata;

    /** @var PropertyAccessor */
    private PropertyAccessor $propertyAccessor;

    public function __construct(
        EntityManagerInterface $entityManager,
        ClassMetadata $classMetadata,
        ?PropertyAccessor $propertyAccessor = null
    ) {
        $this->entityManager = $entityManager;
        $this->classMetadata = $classMetadata;
        $this->propertyAccessor = $propertyAccessor ?? PropertyAccess::createPropertyAccessor();
    }

    /**
     * @param mixed $subjects
     * @param iterable|string[] $associationsPaths
     */
    public function hydrateAssociations(mixed $subjects, iterable $associationsPaths): void
    {
        foreach ($associationsPaths as $associationPath) {
            $this->hydrateAssociation($subjects, $associationPath);
        }
    }

    /**
     * @param mixed $subjects
     * @param string $associationPath
     */
    public function hydrateAssociation(mixed $subjects, string $associationPath): void
    {
        if (null === $subjects || [] === $subjects) {
            return;
        }

        $initialAssociations = explode('.', $associationPath);
        $finalAssociation = array_pop($initialAssociations);
        $subjects = $this->normalizeSubject($subjects);

        $classMetadata = $this->classMetadata;
        foreach ($initialAssociations as $initialAssociation) {
            $subjects = array_reduce($subjects, function (array $accumulator, $subject) use ($initialAssociation) {
                $subject = $this->propertyAccessor->getValue($subject, $initialAssociation);

                return array_merge($accumulator, $this->normalizeSubject($subject));
            }, []);

            if ([] === $subjects) {
                return;
            }

            $classMetadata = $this->entityManager->getClassMetadata($classMetadata->getAssociationTargetClass($initialAssociation));
        }

        $subjects = array_map([$this->entityManager->getUnitOfWork(), 'getEntityIdentifier'], $subjects);

        $this->entityManager->createQueryBuilder()
            ->select('PARTIAL subject.{id}')
            ->addSelect('associations')
            ->from($classMetadata->name, 'subject')
            ->leftJoin(sprintf('subject.%s', $finalAssociation), 'associations')
            ->where('subject IN (:subjects)')
            ->setParameter('subjects', array_unique($subjects, \SORT_REGULAR))
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param mixed $subject
     *
     * @return array
     */
    private function normalizeSubject(mixed $subject): array
    {
        if ($subject instanceof Collection) {
            return $subject->toArray();
        }

        if (!is_array($subject)) {
            return [$subject];
        }

        return $subject;
    }
}
