<?php


namespace App\DataFixtures\Factory;

use Faker\Factory;
use Faker\Generator;
use SM\Factory\FactoryInterface;





use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductReviewExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private ReviewFactoryInterface $productReviewFactory,
        private ProductRepositoryInterface $productRepository,
        private CustomerRepositoryInterface $customerRepository,
        private FactoryInterface $stateMachineFactory,
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): ReviewInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var ReviewInterface $productReview */
        $productReview = $this->productReviewFactory->createForSubjectWithReviewer(
            $options['product'],
            $options['author'],
        );
        $productReview->setTitle($options['title']);
        $productReview->setComment($options['comment']);
        $productReview->setRating($options['rating']);
        $options['product']->addReview($productReview);

        $this->applyReviewTransition($productReview, $options['status'] ?: $this->getRandomStatus());

        return $productReview;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('title', function (Options $options): string {
                /** @var string $words */
                $words = $this->faker->words(3, true);

                return $words;
            })
            ->setDefault('rating', fn (Options $options): int => $this->faker->numberBetween(1, 5))
            ->setDefault('comment', function (Options $options): string {
                /** @var string $sentences */
                $sentences = $this->faker->sentences(3, true);

                return $sentences;
            })
            ->setDefault('author', LazyOption::randomOne($this->customerRepository))
            ->setNormalizer('author', LazyOption::getOneBy($this->customerRepository, 'email'))
            ->setDefault('product', LazyOption::randomOne($this->productRepository))
            ->setNormalizer('product', LazyOption::getOneBy($this->productRepository, 'code'))
            ->setDefault('status', null)
        ;
    }

    private function getRandomStatus(): string
    {
        $statuses = [ReviewInterface::STATUS_NEW, ReviewInterface::STATUS_ACCEPTED, ReviewInterface::STATUS_REJECTED];

        return $statuses[random_int(0, 2)];
    }

    private function applyReviewTransition(ReviewInterface $productReview, string $targetState): void
    {
        /** @var StateMachineInterface $stateMachine */
        $stateMachine = $this->stateMachineFactory->get($productReview, 'product_review');
        $transition = $stateMachine->getTransitionToState($targetState);

        if (null !== $transition) {
            $stateMachine->apply($transition);
        }
    }
}
