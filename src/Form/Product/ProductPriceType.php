<?php

namespace App\Form\Product;

use App\EntityInterface\Product\ProductVariantInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

/**
 * @property $vendorPricingRepository
 */
final class ProductPriceType extends AbstractType
{
    protected string $dataClass = 'data_class';

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string   $dataClass        FQCN
     * @param string[] $validationGroups
     */
    public function __construct(
        array $validationGroups = [],
        string $dataClass = 'data_class',
        //        private readonly $pricingRepository = null,
    ) {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class, [
                'label' => 'ui.price',
                'currency' => $options['vendor']->getBaseCurrency()->getCode(),
            ])
            ->add('originalPrice', MoneyType::class, [
                'label' => 'ui.original_price',
                'required' => false,
                'currency' => $options['vendor']->getBaseCurrency()->getCode(),
            ])
            ->add('minimumPrice', MoneyType::class, [
                'label' => 'ui.minimum_price',
                'required' => false,
                'currency' => $options['vendor']->getBaseCurrency()->getCode(),
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
            $vendorPricing = $event->getData();

            if (!$vendorPricing instanceof $this->dataClass || !$vendorPricing instanceof VendorPricingInterface) {
                $event->setData(null);

                return;
            }

            if (null === $vendorPricing->getPrice() && null === $vendorPricing->getOriginalPrice()) {
                $event->setData(null);

                if (null !== $vendorPricing->getId()) {
                    $this->vendorPricingRepository->remove($vendorPricing);
                }

                return;
            }

            $vendorPricing->setVendorCode($options['vendor']->getCode());
            $vendorPricing->setProductVariant($options['product_variant']);

            $event->setData($vendorPricing);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired('vendor')
            ->setAllowedTypes('vendor', [VendorInterface::class])

            ->setDefined('product_variant')
            ->setAllowedTypes('product_variant', ['null', ProductVariantInterface::class])

            ->setDefaults([
                'label' => fn (Options $options): string => $options['vendor']->getName(),
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'vendor_pricing';
    }
}
