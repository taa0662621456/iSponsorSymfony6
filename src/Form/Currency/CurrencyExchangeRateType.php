<?php

namespace App\Form\Currency;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

final class CurrencyExchangeRateType extends AbstractType
{
    //    protected string $dataClass;
    //
    //    /** @var string[] */
    //    protected array $validationGroups = [];
    //
    //    /**
    //     * @param string $dataClass FQCN
    //     * @param string[] $validationGroups
    //     */
    //    public function __construct(string $dataClass, array $validationGroups = [])
    //    {
    //        $this->dataClass = $dataClass;
    //        $this->validationGroups = $validationGroups;
    //    }
    //
    //    public function buildForm(FormBuilderInterface $builder, array $options): void
    //    {
    //        $builder
    //            ->add('ratio', NumberType::class, [
    //                'label' => 'form.exchange_rate.ratio',
    //                'required' => true,
    //                'invalid_message' => 'exchange_rate.ratio.invalid',
    //                'scale' => 5,
    //                'rounding_mode' => $options['rounding_mode'],
    //            ])
    //        ;
    //
    //        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
    //            /** @var ExchangeRateInterface $exchangeRate */
    //            $exchangeRate = $event->getData();
    //            $form = $event->getForm();
    //
    //            $disabled = null !== $exchangeRate->getId();
    //
    //            $form
    //                ->add('sourceCurrency', CurrencyChoiceType::class, [
    //                    'label' => 'form.exchange_rate.source_currency',
    //                    'required' => true,
    //                    'empty_data' => false,
    //                    'disabled' => $disabled,
    //                ])
    //                ->add('targetCurrency', CurrencyChoiceType::class, [
    //                    'label' => 'form.exchange_rate.target_currency',
    //                    'required' => true,
    //                    'empty_data' => false,
    //                    'disabled' => $disabled,
    //                ])
    //            ;
    //        });
    //    }
    //
    //    public function configureOptions(OptionsResolver $resolver): void
    //    {
    //        parent::configureOptions($resolver);
    //
    //        $resolver->setDefault('rounding_mode', \NumberFormatter::ROUND_HALFEVEN);
    //    }
    //
    //    public function getBlockPrefix(): string
    //    {
    //        return 'exchange_rate';
    //    }
}
