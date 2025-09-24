<?php

namespace App\Form;

use App\Service\MoneyTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class MoneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->resetViewTransformers()
            ->addViewTransformer(new MoneyTransformer(
                $options['scale'],
                $options['grouping'],
                null,
                $options['divisor'],
            ))
        ;
    }

    /**
     * @psalm-suppress MissingPropertyType
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['currency'] = $options['currency'];
    }

    public function getParent(): string
    {
        return \Symfony\Component\Form\Extension\Core\Type\MoneyType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'divisor' => 100,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'money';
    }
}