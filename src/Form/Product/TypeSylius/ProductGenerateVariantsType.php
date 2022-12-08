<?php


namespace App\ProductBundle\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductGenerateVariantsType extends AbstractResourceType
{
    /**
     * @param array|string[] $validationGroups
     */
    public function __construct(
        string $dataClass,
        array $validationGroups,
        private EventSubscriberInterface $generateProductVariantsSubscriber,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('variants', CollectionType::class, [
                'entry_type' => ProductVariantGenerationType::class,
                'allow_add' => false,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->addEventSubscriber($this->generateProductVariantsSubscriber)
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_generate_variants';
    }
}
