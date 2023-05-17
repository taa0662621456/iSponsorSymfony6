<?php

namespace App\Service\DataFixtures;


use App\RepositoryInterface\EntityRepositoryInterface;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\OptionsResolver\Options;
use App\Service\ObjectWorkflowTransitionManager;
use App\Interface\DataFixturesInterface\DataFixturesFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;

class DataFixturesFactory extends AbstractDataFixturesFactory implements DataFixturesFactoryInterface
{
    private ObjectWorkflowTransitionManager $transitionManager;
    private EntityRepositoryInterface $repository;
    private VendorRepositoryInterface $vendorRepository;
    private Registry $workflowRegistry;

    private ?array $entityInterfaces;
    private ?array $entityRepositories;
    private ?array $entityFactoryInterfaces;

    public function __construct(
        ObjectWorkflowTransitionManager $transitionManager,
        EntityRepositoryInterface $repository,
        VendorRepositoryInterface $vendorRepository,
        Registry $workflowRegistry,
        ?array $entityInterfaces = [],
        ?array $entityRepositories = [],
        ?array $entityFactoryInterfaces = [],
    ) {
        parent::__construct();
        $this->entityInterfaces = $entityInterfaces;
        $this->entityRepositories = $entityRepositories;
        $this->entityFactoryInterfaces = $entityFactoryInterfaces;
        $this->repository = $repository;
        $this->transitionManager = $transitionManager;
        $this->vendorRepository = $vendorRepository;
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    /**     * @throws \Exception
     */
    public function create(string $entityName, array $options = []): object
    {
        $options = $this->optionsResolver->resolve($options);

        $entityReviewFactory = $this->getRandomEntityFactory($entityName);

        $data = $this->repository->findPackage();

        // TODO:Заменить на свои свойства
        $entity = $entityReviewFactory->createForSubjectWithReviewer(
            $options['product'],
            $options['author']
        );

        $status = $options['status'] ?: $this->getRandomStatus($options['statuses']);
        $this->transitionManager->applyTransition($entity, $status);

        return $entity;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        // TODO:Заменить на свои свойства
        $resolver
            ->setDefault('title', fn (Options $options) => $this->generateRandomTitle())
            ->setDefault('rating', fn (Options $options) => $this->generateRandomRating())
            ->setDefault('comment', fn (Options $options) => $this->generateRandomComment())
            ->setDefault('status', null);
    }

    private function resolveOptions(array $options): array
    {
        $optionsResolver = new OptionsResolver();
        $this->configureOptions($optionsResolver);

        return $optionsResolver->resolve($options);
    }

    private function getRandomEntityFactory(string $entityName): object
    {
        $entityFactoryInterface = $this->entityFactoryInterfaces[$entityName];

        return $this->faker->randomElement([$entityFactoryInterface]);
    }

    private function generateRandomTitle(): string
    {
        return $this->faker->words(3, true);
    }

    private function generateRandomRating(): int
    {
        return $this->faker->numberBetween(1, 5);
    }

    private function generateRandomComment(): string
    {
        return $this->faker->sentences(3, true);
    }

    private function getRandomVendor()
    {

    }

    private function getVendorByEmail($value)
    {

    }
}
