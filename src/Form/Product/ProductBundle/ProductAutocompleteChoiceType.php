<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use App\Form\ResourceAutocompleteChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductAutocompleteChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'resource' => 'product',
            'choice_name' => 'name',
            'choice_value' => 'code',
        ]);
    }

    /**
     * @psalm-suppress MissingPropertyType
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['remote_criteria_type'] = 'contains';
        $view->vars['remote_criteria_name'] = 'phrase';
    }

    public function getBlockPrefix(): string
    {
        return 'product_autocomplete_choice';
    }

    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }
}
