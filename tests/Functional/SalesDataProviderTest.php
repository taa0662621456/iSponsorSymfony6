<?php

namespace Functional;

use Symfony\Component\BrowserKit\Client;
use Fidry\AliceDataFixtures\LoaderInterface;

use Fidry\AliceDataFixtures\Persistence\PurgeMode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SalesDataProviderTest extends WebTestCase
{
    /** @var Client */
    private static $client;

    protected function setUp(): void
    {
        self::$client = static::createClient();
        self::$client->followRedirects(true);

        /** @var LoaderInterface $fixtureLoader */
        $fixtureLoader = self::$kernel->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');

        $fixtureLoader->load([__DIR__.'/../DataFixtures/ORM/resources/year_sales.yml'], [], [], PurgeMode::createDeleteMode());

        /** @var OrderInterface[] $orders */
        $orders = self::$kernel->getContainer()->get('repository.order')->findAll();
        /** @var OrderProcessorInterface $orderProcessor */
        $orderProcessor = self::$kernel->getContainer()->get('order_processing.order_processor');

        foreach ($orders as $order) {
            $orderProcessor->process($order);
        }

        self::$kernel->getContainer()->get('manager.order')->flush();
    }

    public function testItProvidesYearSalesSummaryGroupedByYear(): void
    {
        $startDate = new \DateTime('2019-01-01 00:00:01');
        $endDate = new \DateTime('2020-12-31 23:59:59');

        $salesSummary = $this->getSummaryForChannel($startDate, $endDate, Interval::year(), 'CHANNEL');

        $expectedPeriods = $this->getExpectedPeriods($startDate, $endDate, '1 year', 'Y');

        $this->assertInstanceOf(SalesSummary::class, $salesSummary);
        $this->assertSame($expectedPeriods, $salesSummary->getIntervals());
        $this->assertSame(['20.00', '110.00'], $salesSummary->getSales());
    }

    public function testItProvidesYearSalesSummaryInChosenYear(): void
    {
        $startDate = new \DateTime('2020-01-01 00:00:01');
        $endDate = new \DateTime('2020-12-31 23:59:59');

        $salesSummary = $this->getSummaryForChannel($startDate, $endDate, Interval::year(), 'CHANNEL');

        $expectedPeriods = $this->getExpectedPeriods($startDate, $endDate, '1 year', 'Y');

        $this->assertInstanceOf(SalesSummary::class, $salesSummary);
        $this->assertSame($expectedPeriods, $salesSummary->getIntervals());
        $this->assertSame(['110.00'], $salesSummary->getSales());
    }

    public function testItProvidesYearSalesSummaryGroupedPerMonth(): void
    {
        $startDate = new \DateTime('2020-01-01 00:00:01');
        $endDate = new \DateTime('2020-12-31 23:59:59');

        $salesSummary = $this->getSummaryForChannel($startDate, $endDate, Interval::month(), 'CHANNEL');
        $expectedPeriods = $this->getExpectedPeriods($startDate, $endDate, '1 month', 'n.Y');

        $this->assertInstanceOf(SalesSummary::class, $salesSummary);
        $this->assertSame($expectedPeriods, $salesSummary->getIntervals());
        $this->assertSame(
            ['70.00', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'],
            $salesSummary->getSales()
        );
    }

    public function testItProvidesYearsSalesSummaryGroupedPerMonth(): void
    {
        $startDate = new \DateTime('2019-01-01 00:00:01');
        $endDate = new \DateTime('2020-12-31 23:59:59');

        $salesSummary = $this->getSummaryForChannel($startDate, $endDate, Interval::month(), 'CHANNEL');
        $expectedPeriods = $this->getExpectedPeriods($startDate, $endDate, '1 month', 'n.Y');

        $this->assertInstanceOf(SalesSummary::class, $salesSummary);
        $this->assertSame($expectedPeriods, $salesSummary->getIntervals());
        $this->assertSame(
            [
                '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '20.00',
                '70.00', '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00',
            ],
            $salesSummary->getSales()
        );
    }

    public function testItProvidesDifferentDataForEachChannelAndOnlyPaidOrders(): void
    {
        $startDate = new \DateTime('2019-01-01 00:00:01');
        $endDate = new \DateTime('2019-12-31 23:59:59');

        $salesSummary = $this->getSummaryForChannel($startDate, $endDate, Interval::year(), 'EXPENSIVE_CHANNEL');
        $expectedMonths = $this->getExpectedPeriods($startDate, $endDate, '1 year', 'Y');

        $this->assertInstanceOf(SalesSummary::class, $salesSummary);
        $this->assertSame($expectedMonths, $salesSummary->getIntervals());
        $this->assertSame(
            ['330.00'],
            $salesSummary->getSales()
        );
    }

    private function getSummaryForChannel(\DateTimeInterface $startDate, \DateTimeInterface $endDate, Interval $interval, string $channelCode): SalesSummaryInterface
    {
        /** @var ChannelRepositoryInterface $channelRepository */
        $channelRepository = self::$kernel->getContainer()->get('repository.channel');
        /** @var ChannelInterface $channel */
        $channel = $channelRepository->findOneByCode($channelCode);

        /** @var SalesDataProviderInterface $salesDataProvider */
        $salesDataProvider = self::$kernel->getContainer()->get(SalesDataProviderInterface::class);

        return $salesDataProvider->getSalesSummary($channel, $startDate, $endDate, $interval);
    }

    private function getExpectedPeriods(\DateTimeInterface $startDate, \DateTimeInterface $endDate, string $interval, string $dateFormat): array
    {
        $expectedPeriods = [];
        $interval = new \DatePeriod(
            $startDate,
            \DateInterval::createFromDateString($interval),
            $endDate
        );

        /** @var \DateTimeInterface $date */
        foreach ($interval as $date) {
            $expectedPeriods[$date->format($dateFormat)] = 0;
        }

        return array_keys($expectedPeriods);
    }
}
