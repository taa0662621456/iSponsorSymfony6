<?php

namespace App\Command\Setup;

use App\Entity\Currency\Currency;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Exception\MissingResourceException;

class SetupCurrencyCommand extends Command
{
//    private ObjectManager $manager;
    /*
     *  Cannot autowire service "App\Command\Setup\SetupCurrencyCommand": argument "$manager" of method "__construct()" ref
    !!    erences interface "Doctrine\Persistence\ObjectManager" but no such service exists. You should maybe alias this inte
    !!    rface to one of these existing services: "App\Repository\Promotion\PromotionRepository", "doctrine.orm.default_enti
    !!    ty_manager", "doctrine.orm.postgres_entity_manager", "doctrine.orm.review_entity_manager", "doctrine.orm.sqlite_ent
    !!    ity_manager".

     */
    private string $currency;
    protected static $defaultName = 'setup.currency';
//
//    public function __construct(
// //        private readonly CurrencyRepositoryInterface $currencyRepository,
//        ObjectManager $manager,
//        string                                       $currency = 'USD',
//    ) {
//        parent::__construct();
//        $this->currency = trim($currency);
// //        $this->manager = $manager;
//    }
//
//    public function setup(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper, $manager): Currency
//    {
//        $code = $this->getCurrencyCodeFromUser($input, $output, $questionHelper);
// //        $currencyRepository = $this->getApplication()->get('repository.currency');
//
// //        /** @var CurrencyInterface|null $existingCurrency */
// //        $existingCurrency = $this->currencyRepository->findOneBy(['code' => $code]);
//
// //        if (null !== $existingCurrency) {
// //            return $existingCurrency;
// //        }
//
//
//        $currency = new Currency();
//
//        $currency->setSlug($code);
//
//        $manager->persist($currency);
//
//        /*
//        /** @var CurrencyInterface $currency *
//        $currency = $this->currencyFactory->createNew();
//        $currency->setCode($code);
//        $this->currencyRepository->add($currency);
//         */
//
//        return $currency;
//    }
//
//    private function getCurrencyCodeFromUser(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
//    {
//        $code = $this->getNewCurrencyCode($input, $output, $questionHelper);
//        $name = $this->getCurrencyName($code);
//
//        while (null === $name) {
//            $output->writeln(
//                sprintf('<comment>Currency with code <info>%s</info> could not be resolved.</comment>', $code),
//            );
//
//            $code = $this->getNewCurrencyCode($input, $output, $questionHelper);
//            $name = $this->getCurrencyName($code);
//        }
//
//        $output->writeln(sprintf('Adding <info>%s</info> currency.', $name));
//
//        return $code;
//    }
//
//    private function getNewCurrencyCode(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
//    {
//        $question = new Question(sprintf('Currency (press enter to use %s): ', $this->currency), $this->currency);
//
//        return trim($questionHelper->ask($input, $output, $question));
//    }
//
//    private function getCurrencyName(string $code): ?string
//    {
//        try {
//            return Currencies::getName($code);
//        } catch (MissingResourceException) {
//            return null;
//        }
//    }
}
