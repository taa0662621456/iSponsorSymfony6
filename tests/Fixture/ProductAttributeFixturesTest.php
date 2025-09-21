<?php

namespace App\Tests\Fixture;

use App\Entity\Product\Product;
use App\Tests\DataFixturesInterface\FixtureRegistryInterface;
use App\Tests\DataFixturesInterface\ListenerRegistryInterface;
use App\Tests\DataFixturesInterface\SuiteLoaderInterface;
use App\Tests\DataFixturesInterface\Suite;
use DateTime;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ProductAttributeFixturesTest extends KernelTestCase
{
    public function testFixturesAreLoadedProperly(): void
    {
        $kernel = self::bootKernel();
        $container = $kernel->getContainer()->get('test.service_container', ContainerInterface::NULL_ON_INVALID_REFERENCE) ?? $kernel->getContainer();

        /** @var FixtureRegistryInterface $fixtureRegistry */
        $fixtureRegistry = $container->get(FixtureRegistryInterface::class);
        /** @var ListenerRegistryInterface $listenerRegistry */
        $listenerRegistry = $container->get(ListenerRegistryInterface::class);
        /** @var SuiteLoaderInterface $suiteLoader */
        $suiteLoader = $container->get(SuiteLoaderInterface::class);

        $suite = new Suite('test');
        $suite->addListener(
            $listenerRegistry->getListener('orm_purger'),
            ['mode' => 'delete', 'exclude' => [], 'managers' => [null]]
        );

        $suite->addFixture(
            $fixtureRegistry->getFixture('locale'),
            ['locales' => [], 'load_default_locale' => true]
        );
        $suite->addFixture(
            $fixtureRegistry->getFixture('taxon'),
            ['custom' => ['books' => ['name' => 'Books', 'code' => 'BOOKS']]]
        );
        $suite->addFixture(
            $fixtureRegistry->getFixture('product_attribute'),
            [
                'custom' => [
                    'book_author' => ['name' => 'Author', 'code' => 'AUTHOR', 'type' => 'text'],
                    'book_date' => ['name' => 'Date', 'code' => 'DATE', 'type' => 'date'],
                    'book_adults_only' => ['name' => 'Adults only', 'code' => 'ADULT', 'type' => 'checkbox'],
                    'book_pages' => ['name' => 'Pages', 'code' => 'PAGES', 'type' => 'integer'],
                    'book_cover' => [
                        'name' => 'Cover',
                        'code' => 'COVER',
                        'type' => 'select',
                        'configuration' => [
                            'choices' => [
                                'SOFT' => ['en_US' => 'Soft'],
                                'HARD' => ['en_US' => 'Hard'],
                            ],
                        ],
                    ],
                ],
            ]
        );
        $suite->addFixture(
            $fixtureRegistry->getFixture('product'),
            [
                'custom' => [
                    'lotr_fellowship' => [
                        'name' => 'The Fellowship of the Ring',
                        'code' => 'LOTR',
                        'product_attributes' => [
                            'AUTHOR' => 'J.R.R Tolkien',
                            'DATE'   => '1954-07-19',
                            'ADULT'  => false,
                            'PAGES'  => 448,
                            'COVER'  => ['SOFT'],
                        ],
                    ],
                ],
            ]
        );

        $suiteLoader->load($suite);

        $productRepository = $container->get('repository.product');

        /** @var Product $product */
        $product = $productRepository->findOneByCode('LOTR');
        $this->assertNotNull($product);

        $this->assertProductAttributeEquals($product, 'DATE', new DateTime('1954-07-19'));
        $this->assertProductAttributeEquals($product, 'ADULT', false);
        $this->assertProductAttributeEquals($product, 'PAGES', 448);
        $this->assertProductAttributeEquals($product, 'COVER', ['SOFT']);
    }

    private function assertProductAttributeEquals(Product $product, string $code, mixed $expected, string $locale = 'en_US'): void
    {
        $attribute = $product->getAttributeByCodeAndLocale($code, $locale);
        $this->assertNotNull($attribute, sprintf('Attribute with code "%s" not found.', $code));

        $actual = $attribute->getValue();

        if ($expected instanceof DateTimeInterface && $actual instanceof DateTimeInterface) {
            $this->assertSame(
                $expected->format('Y-m-d'),
                $actual->format('Y-m-d'),
                sprintf('Failed asserting that attribute "%s" equals expected date.', $code)
            );
        } else {
            $this->assertEquals(
                $expected,
                $actual,
                sprintf('Failed asserting that attribute "%s" equals expected value.', $code)
            );
        }
    }
}
