<?php

namespace App\DataFixtures\Zone;

use Faker\Factory;

use Webmozart\Assert\Assert;

use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Symfony\Component\Intl\Countries;
use Doctrine\Persistence\ObjectManager;
use App\FactoryInterface\Zone\ZoneFactoryInterface;
use App\EntityInterface\Address\AddressCountryInterface;
use App\EntityInterface\Address\AddressProvinceInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ZoneFixtures extends DataFixtures
{
    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property, $n);
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNodeBuilder = $optionsNode->children();

        $optionsNodeBuilder
            ->arrayNode('countries')
                ->performNoDeepMerging()
                ->defaultValue(array_keys(Countries::getNames()))
                ->scalarPrototype();

        $provinceNode = $optionsNodeBuilder
            ->arrayNode('provinces')
                ->normalizeKeys(false)
                ->useAttributeAsKey('code')
                ->arrayPrototype();

        $provinceNode
            ->performNoDeepMerging()
            ->normalizeKeys(false)
            ->useAttributeAsKey('code')
            ->scalarPrototype();

        $zoneNode = $optionsNodeBuilder
            ->arrayNode('zones')
                ->normalizeKeys(false)
                ->useAttributeAsKey('code')
                ->arrayPrototype();

        $zoneNode
            ->performNoDeepMerging()
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->arrayNode('countries')->scalarPrototype()->end()->end()
                ->arrayNode('zones')->scalarPrototype()->end()->end()
                ->arrayNode('provinces')->scalarPrototype()->end()->end()
                ->scalarNode('scope')->end();

        $zoneNode
            ->validate()
                ->ifTrue(function (array $zone): bool {
                    $filledTypes = 0;
                    $filledTypes += empty($zone['countries']) ? 0 : 1;
                    $filledTypes += empty($zone['zones']) ? 0 : 1;
                    $filledTypes += empty($zone['provinces']) ? 0 : 1;

                    return 1 !== $filledTypes;
                })
                ->thenInvalid('Zone must have only one type of members ("countries", "zones", "provinces")');
    }

    private function loadCountriesWithProvinces(array $countriesCodes, array $countriesProvinces): void
    {
        $countries = [];
        foreach ($countriesCodes as $countryCode) {
            /** @var AddressCountryInterface $country */
            $country = $this->countryFactory->createNew();
            $country->enable();
            $country->setCode($countryCode);

            $this->countryManager->persist($country);

            $countries[$countryCode] = $country;
        }

        foreach ($countriesProvinces as $countryCode => $provinces) {
            Assert::keyExists($countries, $countryCode, sprintf('Cannot create provinces for unexisting country "%s"!', $countryCode));

            $this->loadProvincesForCountry($provinces, $countries[$countryCode]);
        }
    }

    private function loadZones(array $zones, \Closure $zoneValidator): void
    {
        foreach ($zones as $zoneCode => $zoneOptions) {
            $zoneName = $zoneOptions['name'];

            try {
                $zoneValidator($zoneOptions);

                $zoneType = $this->getZoneType($zoneOptions);
                $zoneMembers = $this->getZoneMembers($zoneOptions);

                /** @var ZoneFactoryInterface $zone */
                $zone = $this->zoneFactory->createWithMembers($zoneMembers);
                $zone->setCode($zoneCode);
                $zone->setName($zoneName);
                $zone->setType($zoneType);

                if (isset($zoneOptions['scope'])) {
                    $zone->setScope($zoneOptions['scope']);
                }

                $this->zoneManager->persist($zone);
            } catch (\InvalidArgumentException $exception) {
                throw new \InvalidArgumentException(sprintf('An exception was thrown during loading zone "%s" with code "%s"!', $zoneName, $zoneCode), 0, $exception);
            }
        }
    }

    private function loadProvincesForCountry(array $provinces, AddressCountryInterface $country): void
    {
        foreach ($provinces as $provinceCode => $provinceName) {
            /** @var AddressProvinceInterface $province */
            $province = $this->provinceFactory->createNew();

            $province->setCode($provinceCode);
            $province->setName($provinceName);

            $country->addProvince($province);

            $this->provinceManager->persist($province);
        }
    }

    /**
     * @throws \InvalidArgumentException
     *
     *@see ZoneFactoryInterface
     */
    private function getZoneType(array $zoneOptions): string
    {
        return match (true) {
            \count($zoneOptions['countries']) > 0 => ZoneFactoryInterface::TYPE_COUNTRY,
            \count($zoneOptions['provinces']) > 0 => ZoneFactoryInterface::TYPE_PROVINCE,
            \count($zoneOptions['zones']) > 0 => ZoneFactoryInterface::TYPE_ZONE,
            default => throw new \InvalidArgumentException('Cannot resolve zone type!'),
        };
    }

    private function getZoneMembers(array $zoneOptions): array
    {
        $zoneType = $this->getZoneType($zoneOptions);

        return match ($zoneType) {
            ZoneFactoryInterface::TYPE_COUNTRY => $zoneOptions['countries'],
            ZoneFactoryInterface::TYPE_PROVINCE => $zoneOptions['provinces'],
            ZoneFactoryInterface::TYPE_ZONE => $zoneOptions['zones'],
            default => throw new \InvalidArgumentException('Cannot resolve zone members!'),
        };
    }

    private function provideZoneValidator(array $options): \Closure
    {
        $memberValidators = [
            ZoneFactoryInterface::TYPE_COUNTRY => function (string $countryCode) use ($options): void {
                if (\in_array($countryCode, $options['countries'], true)) {
                    return;
                }

                throw new \InvalidArgumentException(sprintf('Could not find country "%s", defined ones are: %s!', $countryCode, implode(', ', $options['countries'])));
            },
            ZoneFactoryInterface::TYPE_PROVINCE => function (string $provinceCode) use ($options): void {
                $foundProvinces = [];
                foreach ($options['provinces'] as $provinces) {
                    if (isset($provinces[$provinceCode])) {
                        return;
                    }

                    $foundProvinces = array_merge($foundProvinces, array_keys($provinces));
                }

                throw new \InvalidArgumentException(sprintf('Could not find province "%s", defined ones are: %s!', $provinceCode, implode(', ', $options['provinces'])));
            },
            ZoneFactoryInterface::TYPE_ZONE => function (string $zoneCode) use ($options): void {
                if (isset($options['zones'][$zoneCode])) {
                    return;
                }

                throw new \InvalidArgumentException(sprintf('Could not find zone "%s", defined ones are: %s!', $zoneCode, implode(', ', array_keys($options['zones']))));
            },
        ];

        return function (array $zoneOptions) use ($memberValidators): void {
            $zoneType = $this->getZoneType($zoneOptions);
            $zoneMembers = $this->getZoneMembers($zoneOptions);

            foreach ($zoneMembers as $zoneMember) {
                $memberValidators[$zoneType]($zoneMember);
            }
        };
    }
}
