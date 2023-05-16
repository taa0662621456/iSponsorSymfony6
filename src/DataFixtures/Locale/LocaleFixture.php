<?php

namespace App\DataFixtures\Locale;

use App\DataFixtures\AbstractDataFixture;
use App\Interface\FactoryInterface;
use App\Interface\Locale\LocaleInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class LocaleFixture extends AbstractDataFixture
{
    /**
     * @param FactoryInterface $localeFactory
     * @param ObjectManager    $localeManager
     * @param string           $baseLocaleCode
     */
    public function __construct(private readonly FactoryInterface $localeFactory,
                                private readonly ObjectManager    $localeManager,
                                private readonly string           $baseLocaleCode)
    {
        parent::__construct();
    }

    public function load($options): void
    {
        $localesCodes = $options['locales'];

        if ($options['load_default_locale']) {
            array_unshift($localesCodes, $this->baseLocaleCode);
        }

        $localesCodes = array_unique($localesCodes);

        foreach ($localesCodes as $localeCode) {
            /** @var LocaleInterface $locale */
            $locale = $this->localeFactory->createNew();

            $locale->setCode($localeCode);

            $this->localeManager->persist($locale);
        }

        $this->localeManager->flush();
    }

    public function getName(): string
    {
        return 'locale';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->scalarNode('load_default_locale')->defaultTrue()->end()
                ->arrayNode('locales')->scalarPrototype()->end()
        ;
    }
}
