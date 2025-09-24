<?php

namespace App\Service\Order;






final class OrderSequentialNumberGenerator implements OrderNumberGeneratorInterface
{
    public function __construct(
        private readonly RepositoryInterface $sequenceRepository,
        private readonly FactoryInterface    $sequenceFactory,
        private readonly int                 $startNumber = 1,
        private readonly int                 $numberLength = 9,
    ) {
    }

    public function generate(OrderInterface $order): string
    {
        $sequence = $this->getSequence();

        $number = $this->generateNumber($sequence->getIndex());
        $sequence->incrementIndex();

        return $number;
    }

    private function generateNumber(int $index): string
    {
        $number = $this->startNumber + $index;

        return str_pad((string) $number, $this->numberLength, '0', \STR_PAD_LEFT);
    }

    private function getSequence(): OrderSequenceInterface
    {
        /** @var OrderSequenceInterface|null $sequence */
        $sequence = $this->sequenceRepository->findOneBy([]);

        if (null === $sequence) {
            $sequence = $this->sequenceFactory->createNew();
            $this->sequenceRepository->add($sequence);
        }

        return $sequence;
    }
}