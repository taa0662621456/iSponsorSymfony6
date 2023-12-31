<?php

namespace App\Form;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** @experimental */
final class ResourceAutocompleteFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired([
                'remote_path',
                'load_edit_path',
            ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['remote_criteria_type'] = 'contains';
        $view->vars['remote_criteria_name'] = 'phrase';
    }

    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'grid_filter_resource_autocomplete';
    }
}
