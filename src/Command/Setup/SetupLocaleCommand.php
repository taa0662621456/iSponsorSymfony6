<?php

namespace App\Command\Setup;

use App\Entity\Locale\Locale;
use App\Interface\Currency\CurrencyInterface;
use App\Repository\LocaleRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Locale as Intl;


class SetupLocaleCommand extends Command
{
    protected static $defaultName = 'setup.locale';
    private string $locale;

    public function __construct(
        private readonly LocaleRepository $localeRepository,
        string                            $locale = 'en-US',
    ) {
        parent::__construct();
        $this->locale = $locale;
    }

    public function setup(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper, ?ObjectManager $manager): string
    {
        $locale = $this->localeCodeQuestion($input, $output, $questionHelper);
        $localeRepository = $this->getApplication()->get('repository.locale');

        /** @var CurrencyInterface|null $existingCurrency */
        $existingCurrency = $this->localeRepository->findOneBy(['locale' => $locale]);

//        if (null !== $existingCurrency) {
//            return $existingCurrency;
//        }


        $localeEntity = new Locale();

        $localeEntity->setSlug($locale);

        $manager->persist($localeEntity);

        /*
        /** @var CurrencyInterface $currency *
        $currency = $this->currencyFactory->createNew();
        $currency->setCode($code);
        $this->currencyRepository->add($currency);
         */

        return $locale;
    }

    private function localeCodeQuestion(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $code = $this->localeCode($input, $output, $questionHelper);
        $name = $this->getLocaleName($code);

        while (null === $name) {
            $output->writeln(
                sprintf('<comment>Currency with code <info>%s</info> could not be resolved.</comment>', $code),
            );

            $code = $this->localeCode($input, $output, $questionHelper);
            $name = $this->getLocaleName($code);
        }

        $output->writeln(sprintf('Adding <info>%s</info> currency.', $name));

        return $code;
    }

    private function localeCode(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $question = new Question(sprintf('Currency (press enter to use %s): ', $this->locale), $this->locale);

        return trim($questionHelper->ask($input, $output, $question));
    }

    private function getLocaleName(string $code): ?string
    {
        try {
            return Intl::getDisplayName($code);
        } catch (MissingResourceException) {
            return null;
        }
    }

}
