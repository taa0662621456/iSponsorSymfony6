<?php

namespace App\Command\Vendor;

use App\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'app:list-vendors',
    description: 'Lists all the vendors from the Vendor table',
    aliases: ['app:vendors']
)]
class VendorListCommand extends Command
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp(<<<'HELP'
                The <info>%command.name%</info> command lists all the vendors from the Vendor table:

                  <info>php %command.full_name%</info>

                By default, the command displays all vendors. You can limit the number of
                results with the <comment>--max-results</comment> option:

                  <info>php %command.full_name%</info> <comment>--max-results=50</comment>
                HELP
            )
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, 'Limits the number of vendors listed', 50);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $maxResults = $input->getOption('max-results');

        $vendorRepository = $this->entityManager->getRepository(Vendor::class);
        $vendors = $vendorRepository->findBy([], ['id' => 'DESC'], $maxResults);

        $vendorsAsPlainArrays = array_map(static function (Vendor $vendor) {
            return [
                $vendor->getId(),
                $vendor->getFirstTitle(),
                $vendor->getIsActive(),
            ];
        }, $vendors);

        $io = new SymfonyStyle($input, $output);
        $io->table(
            ['ID', 'Name', 'Email'],
            $vendorsAsPlainArrays
        );

        return Command::SUCCESS;
    }
}
