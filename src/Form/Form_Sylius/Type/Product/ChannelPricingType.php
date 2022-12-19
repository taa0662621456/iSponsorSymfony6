<?php


namespace App\CoreBundle\Form\Type\Product;




use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelPricingType extends AbstractResourceType
{
    public function __construct(
        string $dataClass,
        array $validationGroups,
        private ?\SyliusInterface $channelPricingRepository = null,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class, [
                'label' => 'ui.price',
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
            ])
            ->add('originalPrice', MoneyType::class, [
                'label' => 'ui.original_price',
                'required' => false,
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
            ])
            ->add('minimumPrice', MoneyType::class, [
                'label' => 'ui.minimum_price',
                'required' => false,
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
            ])
        ;

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
            $channelPricing = $event->getData();

            if (!$channelPricing instanceof $this->dataClass || !$channelPricing instanceof ChannelPricingInterface) {
                $event->setData(null);

                return;
            }

            if ($channelPricing->getPrice() === null && $channelPricing->getOriginalPrice() === null) {
                $event->setData(null);

                if ($channelPricing->getId() !== null) {
                    $this->channelPricingRepository->remove($channelPricing);
                }

                return;
            }

            $channelPricing->setChannelCode($options['channel']->getCode());
            $channelPricing->setProductVariant($options['product_variant']);

            $event->setData($channelPricing);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired('channel')
            ->setAllowedTypes('channel', [ChannelInterface::class])

            ->setDefined('product_variant')
            ->setAllowedTypes('product_variant', ['null', ProductVariantInterface::class])

            ->setDefaults([
                'label' => fn (Options $options): string => $options['channel']->getName(),
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'channel_pricing';
    }
}
