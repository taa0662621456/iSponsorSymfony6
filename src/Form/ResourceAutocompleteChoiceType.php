<?php

namespace App\Form;

use Webmozart\Assert\Assert;
use Symfony\Component\Form\FormView;
use App\Service\RecursiveTransformer;
use App\Interface\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use App\Interface\ServiceRegistryInterface;
use App\Service\CollectionToStringTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ResourceAutocompleteChoiceType extends AbstractType
{
    //    protected ServiceRegistryInterface $resourceRepositoryRegistry;
    //
    //    public function __construct(ServiceRegistryInterface $resourceRepositoryRegistry)
    //    {
    //        $this->resourceRepositoryRegistry = $resourceRepositoryRegistry;
    //    }
    //
    //    public function buildForm(FormBuilderInterface $builder, array $options): void
    //    {
    //        Assert::isInstanceOf($options['repository'], RepositoryInterface::class);
    //        Assert::nullOrString($options['choice_value']);
    //
    //        if (!$options['multiple']) {
    //            $builder->addModelTransformer(
    //                new ResourceToIdentifierTransformer(
    //                    $options['repository'],
    //                    $options['choice_value'],
    //                ),
    //            );
    //        }
    //
    //        if ($options['multiple']) {
    //            $builder
    //                ->addModelTransformer(
    //                    new RecursiveTransformer(
    //                        new ResourceToIdentifierTransformer(
    //                            $options['repository'],
    //                            $options['choice_value'],
    //                        ),
    //                    ),
    //                )
    //                ->addViewTransformer(new CollectionToStringTransformer(','))
    //            ;
    //        }
    //    }
    //
    //    /**
    //     * @psalm-suppress MissingPropertyType
    //     */
    //    public function buildView(FormView $view, FormInterface $form, array $options): void
    //    {
    //        $view->vars['multiple'] = $options['multiple'];
    //        $view->vars['choice_name'] = $options['choice_name'];
    //        $view->vars['choice_value'] = $options['choice_value'];
    //        $view->vars['placeholder'] = $options['placeholder'];
    //    }
    //
    //    public function configureOptions(OptionsResolver $resolver): void
    //    {
    //        $resolver
    //            ->setRequired([
    //                'resource',
    //                'choice_name',
    //                'choice_value',
    //            ])
    //            ->setDefaults([
    //                'multiple' => false,
    //                'error_bubbling' => false,
    //                'placeholder' => '',
    //                'repository' => function (Options $options) {
    //                    Assert::string($options['resource']);
    //
    //                    return $this->resourceRepositoryRegistry->get($options['resource']);
    //                },
    //            ])
    //            ->setAllowedTypes('resource', ['string'])
    //            ->setAllowedTypes('multiple', ['bool'])
    //            ->setAllowedTypes('choice_name', ['string'])
    //            ->setAllowedTypes('choice_value', ['string'])
    //            ->setAllowedTypes('placeholder', ['string'])
    //        ;
    //    }
    //
    //    public function getParent(): string
    //    {
    //        return HiddenType::class;
    //    }
    //
    //    public function getBlockPrefix(): string
    //    {
    //        return 'sylius_resource_autocomplete_choice';
    //    }
}
