<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * @property $generateProductVariantsSubscriber
 */
final class ProductGenerateVariantsType extends AbstractType
{
    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string   $dataClass        FQCN
     * @param string[] $validationGroups
     */
    public function __construct(string $dataClass = 'data_class', array $validationGroups = [])
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
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
            ->addEventSubscriber($this->generateProductVariantsSubscriber);
    }

    public function getBlockPrefix(): string
    {
        return 'product_generate_variants';
    }
}