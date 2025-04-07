<?php


namespace App\Extension;


use App\EntityInterface\Product\ProductInterface;
use App\Form\Cart\CartItemType;
use App\Form\Product\ProductBundle\ProductVariantChoiceType;
use App\Form\Product\ProductBundle\ProductVariantMatchType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * We extend the item form type a bit, to add a variant select field
 * when we're adding product to cart, but not when we edit quantity in cart.
 * We'll use simple option for that, passing the product instance required by
 * variant choice type.
 */
final class CartItemTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('quantity', IntegerType::class, [
            'attr' => ['min' => 1],
            'label' => 'ui.quantity',
        ]);

        if (isset($options['product']) && $options['product']->hasVariants() && !$options['product']->isSimple()) {
            $type =
                Product::VARIANT_SELECTION_CHOICE === $options['product']->getVariantSelectionMethod()
                ? ProductVariantChoiceType::class
                : ProductVariantMatchType::class
            ;

            $builder->add('variant', $type, [
                'product' => $options['product'],
            ]);
        }
    }

    /**
     * We need to override this method to allow setting 'product'
     * option, by default it will be null so we don't get the variant choice
     * when creating full cart form.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefined([
                'product',
            ])
            ->setAllowedTypes('product', ProductInterface::class)
        ;
    }

    public function getExtendedType(): string
    {
        return CartItemType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [CartItemType::class];
    }
}
