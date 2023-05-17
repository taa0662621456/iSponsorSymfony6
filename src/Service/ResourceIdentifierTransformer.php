<?php
namespace App\Service;

use App\RepositoryInterface\EntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Assert;
use ReflectionClass;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Config\Resource\ResourceInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ResourceIdentifierTransformer implements DataTransformerInterface
{
    private string $entityRepository;
    private EntityManagerInterface $entityManager;
    private string $identifier;

    /**
     * @throws \ReflectionException
     */
    public function __construct(EntityManagerInterface $entityManager, string $identifier = null, string $entityRepository = null)
    {
        $this->entityManager = $entityManager;
        $this->identifier = $identifier ?? 'id';

        $reflection = new ReflectionClass($entityRepository);
        $repositoryClassName = str_replace('Interface', '', $reflection->getShortName());
        $repositoryNamespace = $reflection->getNamespaceName();
        $repositoryClass = $repositoryNamespace . '\\' . $repositoryClassName;

        $this->entityRepository = new $repositoryClass($entityManager);
    }

    /**
     * @psalm-suppress MissingReturnType
     * @psalm-suppress MissingParamType
     * @param object|null $value
     * @return mixed|null
     */
    public function transform($value): ?int
    {
        if (null === $value) {
            return null;
        }

        /* @psalm-suppress ArgumentTypeCoercion */
        Assert::isInstanceOf($value, $this->getEntityClassName());

        return PropertyAccess::createPropertyAccessor()->getValue($value, $this->identifier);
    }

    /**
     * @param int|string|null $value
     *
     * @throws \ReflectionException
     */
    public function reverseTransform($value): ?ResourceInterface
    {
        if (null === $value) {
            return null;
        }

        /** @var ResourceInterface|null $resource */
        $resource = $this->entityRepository->findOneBy([$this->identifier => $value]);
        if (null === $resource) {
            throw new TransformationFailedException(sprintf('Object "%s" with identifier "%s"="%s" does not exist.',
                $this->getEntityClassName(),
                $this->identifier,
                $value
            ));
        }

        return $resource;
    }

    private function getEntityClassName(): string
    {
        return get_class($this->entityRepository);
    }

    private function getEntityName(EntityRepositoryInterface $entityRepository): string
    {
        $reflectionClass = new \ReflectionClass($entityRepository);

        return $reflectionClass->getShortName();
    }
}
