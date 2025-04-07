<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\AbstractType as SymfonyAbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractType extends SymfonyAbstractType
{
    /** @var DataTransformerInterface */
    protected DataTransformerInterface $resourceToIdentifierTransformer;

    public function __construct(ResourceIdentifierTransformer $resourceToIdentifierTransformer)
    {
        $this->resourceToIdentifierTransformer = $resourceToIdentifierTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->resourceToIdentifierTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form) {
                return $this->getValidationGroups($form);
            },
        ]);
    }

    protected function getValidationGroups(FormInterface $form): array
    {
        // Implement your custom logic to determine validation groups for the form
        // You can access the current form data using $form->getData()

        return ['Default'];
    }
}
