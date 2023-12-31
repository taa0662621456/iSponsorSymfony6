<?php

namespace App\Form\Currency;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use App\Repository\Currency\CurrencyRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;

final class CurrencySelectorType extends AbstractType
{
    public function __construct(private readonly CurrencyRepository $currencyRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => fn (Options $options): array => $this->currencyRepository->findAll(),
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'currency_choice';
    }
}
