<?php

namespace App\Service\Fixture;

use App\Interface\Fixture\FixtureFactoryInterface;
use App\Interface\Vendor\VendorRepositoryInterface;
use App\Repository\Vendor\VendorRepository;
use App\Service\ObjectWorkflowTransitionManager;
use App\Service\Sylius_OptionsResolver\LazyOption;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Workflow\Registry;

class FixtureFactory extends AbstractFixtureFactory implements FixtureFactoryInterface
{
    private ObjectWorkflowTransitionManager $transitionManager;
    private VendorRepository $vendorRepository;
    private Registry $workflowRegistry;
    private array $entityInterfaces;
    private array $entityRepositories;
    private array $entityFactoryInterfaces;

    public function __construct(
        array $entityInterfaces,
        array $entityRepositories,
        array $entityFactoryInterfaces,
                                ObjectWorkflowTransitionManager $transitionManager,
                                Registry $workflowRegistry,
                                VendorRepositoryInterface $vendorRepository
    ) {
        parent::__construct();
        $this->entityInterfaces = $entityInterfaces;
        $this->entityRepositories = $entityRepositories;
        $this->entityFactoryInterfaces = $entityFactoryInterfaces;
        $this->transitionManager = $transitionManager;
        $this->vendorRepository = $vendorRepository;
    }

    /**     * @throws \Exception
     */
    public function create(string $entityName, array $options = []): object
    {
        $options = $this->optionsResolver->resolve($options);

        $entityReviewFactory = $this->getRandomEntityFactory($entityName);

        // TODO:Заменить на свои свойства
        $entity = $entityReviewFactory->createForSubjectWithReviewer(
            $options['product'],
            $options['author']
        );

        // TODO:Заменить на свои свойства
        $entity->setTitle($options['title']);
        $entity->setComment($options['comment']);
        $entity->setRating($options['rating']);
        $options['product']->addReview($entity);

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
            ->setDefault('author', fn (Options $options) => $this->getRandomVendor())
            ->setNormalizer('author', fn (Options $options, $value) => $this->getVendorByEmail($value))
            ->setDefault('status', null)
        ;
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

    private function getRandomVendor(): object
    {
        return LazyOption::randomOne($this->vendorRepository);
    }

    private function getVendorByEmail(string $email): object
    {
        return LazyOption::getOneBy($this->vendorRepository, 'email', (array) $email);
    }
}
