<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use ReflectionException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use function count;
use function is_array;
use const SORT_REGULAR;

class EntityAssociationHydrator
{
    private EntityManagerInterface $entityManager;

    private PropertyAccessor $propertyAccessor;

    /**
     * Конструктор класса AssociationHydrate.
     *
     * @param EntityManagerInterface $entityManager    объект EntityManager для работы с сущностями
     * @param ClassMetadata          $classMetadata    метаданные класса, используемые для получения информации об ассоциациях
     * @param PropertyAccessor|null  $propertyAccessor объект PropertyAccessor для доступа к свойствам сущностей
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        private readonly ClassMetadata $classMetadata,
        PropertyAccessor $propertyAccessor = null
    ) {
        $this->entityManager = $entityManager;
        $this->propertyAccessor = $propertyAccessor ?? PropertyAccess::createPropertyAccessor();
    }

    /**
     * Гидратация всех ассоциаций для указанных субъектов.
     *
     * @param mixed             $subjects          субъекты, для которых нужно выполнить гидратацию ассоциаций
     * @param iterable|string[] $associationsPaths пути к ассоциациям, которые нужно гидратировать
     *
     * @throws ReflectionException
     */
    public function hydrateAssociations(mixed $subjects, iterable $associationsPaths): void
    {
        foreach ($associationsPaths as $associationPath) {
            $this->hydrateAssociation($subjects, $associationPath);
        }
    }

    /**
     * Гидратация указанной ассоциации для указанных субъектов.
     *
     * @param mixed  $subjects        субъекты, для которых нужно выполнить гидратацию ассоциации
     * @param string $associationPath путь к ассоциации, которую нужно гидратировать
     *
     * @throws ReflectionException
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

        $subjectIds = array_map(fn ($subject) => $this->getEntityIdentifier($subject), $subjects);

        // Получаем репозиторий ServiceEntityRepository для класса и строим запрос
        $repository = $this->entityManager->getRepository($classMetadata->getName());
        $queryBuilder = $repository->createQueryBuilder('subject')
            ->select('partial subject.{id}')
            ->addSelect('associations')
            ->leftJoin("subject.$finalAssociation", 'associations')
            ->where('subject IN (:subjectIds)')
            ->setParameter('subjectIds', array_unique($subjectIds, SORT_REGULAR));

        $query = $queryBuilder->getQuery();
        $query->getResult();
    }

    /**
     * Преобразует субъекты в нормализованный массив.
     *
     * @param mixed $subject субъекты, которые нужно нормализовать
     *
     * @return array нормализованный массив субъектов
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

    /**
     * Получает идентификатор сущности.
     *
     * @param object $entity сущность, для которой нужно получить идентификатор
     *
     * @return mixed идентификатор сущности
     */
    private function getEntityIdentifier(object $entity): mixed
    {
        $classMetadata = $this->entityManager->getClassMetadata($entity::class);
        $identifier = $classMetadata->getIdentifierValues($entity);

        return 1 === count($identifier) ? reset($identifier) : $identifier;
    }
}