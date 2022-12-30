<?php


namespace App\DataFixtures\Factory;

use Faker\Factory;
use Faker\Generator;
use SyliusInterface as CustomerComponent;


use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopUserExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private readonly FactoryInterface    $shopUserFactory,
        private readonly FactoryInterface    $customerFactory,
        private readonly RepositoryInterface $customerGroupRepository,
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): ShopUserInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var CustomerInterface $customer */
        $customer = $this->customerFactory->createNew();
        $customer->setEmail($options['email']);
        $customer->setFirstName($options['first_name']);
        $customer->setLastName($options['last_name']);
        $customer->setGroup($options['customer_group']);
        $customer->setGender($options['gender']);
        $customer->setPhoneNumber($options['phone_number']);
        $customer->setBirthday($options['birthday']);

        /** @var ShopUserInterface $user */
        $user = $this->shopUserFactory->createNew();
        $user->setPlainPassword($options['password']);
        $user->setEnabled($options['enabled']);
        $user->addRole('ROLE_USER');
        $user->setCustomer($customer);

        return $user;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('email', fn (Options $options): string => $this->faker->email)
            ->setDefault('first_name', fn (Options $options): string => $this->faker->firstName)
            ->setDefault('last_name', fn (Options $options): string => $this->faker->lastName)
            ->setDefault('enabled', true)
            ->setAllowedTypes('enabled', 'bool')
            ->setDefault('password', 'password123')
            ->setDefault('customer_group', LazyOption::randomOneOrNull($this->customerGroupRepository, 100))
            ->setAllowedTypes('customer_group', ['null', 'string', CustomerGroupInterface::class])
            ->setNormalizer('customer_group', LazyOption::findOneBy($this->customerGroupRepository, 'code'))
            ->setDefault('gender', CustomerComponent::UNKNOWN_GENDER)
            ->setAllowedValues(
                'gender',
                [CustomerComponent::UNKNOWN_GENDER, CustomerComponent::MALE_GENDER, CustomerComponent::FEMALE_GENDER],
            )
            ->setDefault('phone_number', fn (Options $options): string => $this->faker->phoneNumber)
            ->setDefault('birthday', fn (Options $options): \DateTime => $this->faker->dateTimeThisCentury())
            ->setAllowedTypes('birthday', ['null', 'string', \DateTimeInterface::class])
            ->setNormalizer(
                'birthday',
                function (Options $options, string|\DateTimeInterface|null $value) {
                    if (is_string($value)) {
                        return \DateTime::createFromFormat('Y-m-d H:i:s', $value);
                    }

                    return $value;
                },
            )
        ;
    }
}