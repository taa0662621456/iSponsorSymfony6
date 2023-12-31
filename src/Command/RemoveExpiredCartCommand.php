<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveExpiredCartCommand extends Command
{
    protected static $defaultName = 'remove-expired-cart';

    protected function configure(): void
    {
        $this
            ->setDescription('Removes carts that have been idle for a period set in `order.expiration.cart` configuration key.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $expirationTime = $this->getApplication()->get('order.cart_expiration_period');
        $output->writeln(sprintf(
            'Command will remove carts that have been idle for <info>%s</info>.',
            (string) $expirationTime,
        ));

        $expiredCartsRemover = $this->getApplication()->get('expired_cart_remover');
        $expiredCartsRemover->remove();

        return 0;
    }
}
