<?php


namespace App\ProductBundle\Form\Type;




use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductType extends AbstractResourceType
{
    /**
     * @param array|string[] $validationGroups
     */
    public function __construct(
        string $dataClass,
        array $validationGroups,
        private ProductVariantResolverInterface $variantResolver,
        private FactoryInterface $attributeValueFactory,
        private TranslationLocaleProviderInterface $localeProvider,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->addEventSubscriber(new ProductOptionFieldSubscriber($this->variantResolver))
            ->addEventSubscriber(new SimpleProductSubscriber())
            ->addEventSubscriber(new BuildAttributesFormSubscriber($this->attributeValueFactory, $this->localeProvider))
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'form.product.enabled',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductTranslationType::class,
                'label' => 'form.product.translations',
            ])
            ->add('attributes', CollectionType::class, [
                'entry_type' => ProductAttributeValueType::class,
                'required' => false,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('associations', ProductAssociationsType::class, [
                'label' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product';
    }
}
