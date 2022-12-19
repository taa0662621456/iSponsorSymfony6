<?php


namespace App\CoreBundle\Installer\Setup;

use App\Interface\CurrencyFactoryInterface;
use App\Interface\CurrencyInterface;
use App\Interface\CurrencyRepositoryInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Exception\MissingResourceException;

final class CurrencySetup implements CurrencySetupInterface
{
    private string $currency;

    public function __construct(
        private readonly CurrencyRepositoryInterface $currencyRepository,
        private readonly CurrencyFactoryInterface    $currencyFactory,
        string                                       $currency = 'USD',
    ) {
        $this->currency = trim($currency);
    }

    public function setup(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): CurrencyInterface
    {
        $code = $this->getCurrencyCodeFromUser($input, $output, $questionHelper);

        /** @var CurrencyInterface|null $existingCurrency */
        $existingCurrency = $this->currencyRepository->findOneBy(['code' => $code]);
        if (null !== $existingCurrency) {
            return $existingCurrency;
        }

        /** @var CurrencyInterface $currency */
        $currency = $this->currencyFactory->createNew();
        $currency->setCode($code);

        $this->currencyRepository->add($currency);

        return $currency;
    }

    private function getCurrencyCodeFromUser(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $code = $this->getNewCurrencyCode($input, $output, $questionHelper);
        $name = $this->getCurrencyName($code);

        while (null === $name) {
            $output->writeln(
                sprintf('<comment>Currency with code <info>%s</info> could not be resolved.</comment>', $code),
            );

            $code = $this->getNewCurrencyCode($input, $output, $questionHelper);
            $name = $this->getCurrencyName($code);
        }

        $output->writeln(sprintf('Adding <info>%s</info> currency.', $name));

        return $code;
    }

    private function getNewCurrencyCode(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): string
    {
        $question = new Question(sprintf('Currency (press enter to use %s): ', $this->currency), $this->currency);

        return trim($questionHelper->ask($input, $output, $question));
    }

    private function getCurrencyName(string $code): ?string
    {
        try {
            return Currencies::getName($code);
        } catch (MissingResourceException) {
            return null;
        }
    }
}
