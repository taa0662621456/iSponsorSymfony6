<?php

namespace App\DataFixtures\Order;

use App\DataFixtures\AbstractDataFixture;
use App\Factory\Order\OrderFakeDataFactory;
use App\Interface\Fixture\FixtureFactoryInterface;
use App\Interface\Order\OrderItemQuantityModifierInterface;
use App\Interface\Order\OrderPaymentMethodSelectionRequirementCheckerInterface;
use App\Interface\Order\OrderShippingMethodSelectionRequirementCheckerInterface;
use App\Interface\Payment\PaymentMethodRepositoryInterface;
use App\Interface\RepositoryInterface;
use App\Intrface\StateMachine\StateMachineFactoryInterface;
use App\Service\FakeGenerator;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class OrderFixture extends AbstractDataFixture
{
    protected ?OrderFakeDataFactory $orderExampleFactory;

    protected ObjectManager $orderManager;

    private FakeGenerator $faker;

    public function __construct(
        FixtureFactoryInterface $orderFactory,
        FixtureFactoryInterface $orderItemFactory,
        OrderItemQuantityModifierInterface $orderItemQuantityModifier,
        ObjectManager $orderManager,
        RepositoryInterface $channelRepository,
        RepositoryInterface $customerRepository,
        RepositoryInterface $productRepository,
        RepositoryInterface $countryRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ShippingMethodRepositoryInterface $shippingMethodRepository,
        FixtureFactoryInterface $addressFactory,
        StateMachineFactoryInterface $stateMachineFactory,
        OrderShippingMethodSelectionRequirementCheckerInterface $orderShippingMethodSelectionRequirementChecker,
        OrderPaymentMethodSelectionRequirementCheckerInterface $orderPaymentMethodSelectionRequirementChecker,
        ?OrderExampleFactory $orderExampleFactory = null
    ) {
        parent::__construct();
        if (null === $orderExampleFactory) {
            $orderExampleFactory = new OrderFakeDataFactory(
                $orderFactory,
                $orderItemFactory,
                $orderItemQuantityModifier,
                $orderManager,
                $channelRepository,
                $customerRepository,
                $productRepository,
                $countryRepository,
                $paymentMethodRepository,
                $shippingMethodRepository,
                $addressFactory,
                $stateMachineFactory,
                $orderShippingMethodSelectionRequirementChecker,
                $orderPaymentMethodSelectionRequirementChecker
            );

            @trigger_error('Use orderExampleFactory. OrderFixture is deprecated since 1.6 and will be prohibited since 2.0.', \E_USER_DEPRECATED);
        }

        $this->orderManager = $orderManager;
        $this->orderExampleFactory = $orderExampleFactory;

        $this->faker = Factory::create();
    }

    public function load($manager): void
    {
        $generateDates = $this->generateDates($manager['amount']);

        $batchSize = 50;
        $batchCount = 0;

        for ($i = 0; $i < $manager['amount']; ++$i) {
            $option = array_merge((array) $manager, ['complete_date' => array_shift($generateDates)]);

            $order = $this->orderExampleFactory->create($option);

            $this->orderManager->persist($order);

            ++$batchCount;

            if ($batchCount === $batchSize) {
                $this->orderManager->flush();
                $this->orderManager->clear();
                $batchCount = 0;
            }
        }

        $this->orderManager->flush();
    }

    public function getName(): string
    {
        return 'order';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->integerNode('amount')->isRequired()->min(0)->end()
            ->scalarNode('channel')->cannotBeEmpty()->end()
            ->scalarNode('customer')->cannotBeEmpty()->end()
            ->scalarNode('country')->cannotBeEmpty()->end()
            ->booleanNode('fulfilled')->defaultValue(false)->end()
            ->end();
    }

    private function generateDates(int $amount): array
    {
        $dates = [];

        for ($i = 0; $i < $amount; ++$i) {
            $date = $this->faker->dateTimeBetween('-1 years', 'now');
            $dates[] = $date->format('Y-m-d H:i:s');
        }

        sort($dates);

        return $dates;
    }
}
