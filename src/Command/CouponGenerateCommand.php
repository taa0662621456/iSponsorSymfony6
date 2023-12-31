<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use App\Repository\Promotion\PromotionRepository;
use App\Service\Coupon\CouponGeneratorInstruction;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\EntityInterface\Coupon\CouponGeneratorInterface;
use App\EntityInterface\Coupon\CouponGeneratorInstructionInterface;

final class CouponGenerateCommand extends Command
{
    protected static $defaultName = 'coupon:coupon-generator';

    public function __construct(
        private readonly PromotionRepository $promotionRepository,
        private readonly CouponGeneratorInterface $couponGenerator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generates coupons for a given promotion')
            ->addArgument('promotion-code', InputArgument::REQUIRED, 'Code of the promotion')
            ->addArgument('count', InputArgument::REQUIRED, 'Amount of coupons to generate')
            ->addOption('length', 'len', InputOption::VALUE_OPTIONAL, 'Length of the coupon code (default 10)', '10');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $promotionCode */
        $promotionCode = $input->getArgument('promotion-code');

        /** @var PromotionInterface|null $promotion */
        $promotion = $this->promotionRepository->findOneBy(['code' => $promotionCode]);

        if (null === $promotion) {
            $output->writeln('<error>No promotion found with this code</error>');

            return 1;
        }

        if (!$promotion->isCouponBased()) {
            $output->writeln('<error>This promotion is not coupon based</error>');

            return 1;
        }

        $instruction = $this->getGeneratorInstructions(
            (int) $input->getArgument('count'),
            (int) $input->getOption('length'),
        );

        try {
            $this->couponGenerator->generate($promotion, $instruction);
        } catch (\Exception $exception) {
            $output->writeln('<error>'.$exception->getMessage().'</error>');

            return 1;
        }

        $output->writeln('<info>Coupons have been generated</info>');

        return 0;
    }

    public function getGeneratorInstructions(int $count, int $codeLength): CouponGeneratorInstructionInterface
    {
        $instruction = new CouponGeneratorInstruction();
        $instruction->setAmount($count);
        $instruction->setCodeLength($codeLength);

        return $instruction;
    }
}
