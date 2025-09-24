<?php


namespace App\EventSubscriber\Product;

use App\Interface\FactoryInterface;
use App\Interface\TranslationLocaleProviderInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class BuildAttributesFormSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly FactoryInterface                   $attributeValueFactory,
        private readonly TranslationLocaleProviderInterface $localeProvider,
    ) {
    }

    #[ArrayShape([FormEvents::PRE_SET_DATA => "string", FormEvents::POST_SUBMIT => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit',
        ];
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        /** @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        $defaultLocaleCode = $this->localeProvider->getDefaultLocaleCode();

        $attributes = $product->getAttributes()->filter(
            fn ($attribute) => $attribute->getLocaleCode() === $defaultLocaleCode,
        );

        /** @var ProductAttributeValueInterface $attribute */
        foreach ($attributes as $attribute) {
            $this->resolveLocalizedAttributes($product, $attribute);
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function postSubmit(FormEvent $event): void
    {
        $product = $event->getData();

        /** @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        /** @var AttributeValueInterface $attribute */
        foreach ($product->getAttributes() as $attribute) {
            if (null === $attribute->getValue()) {
                $product->removeAttribute($attribute);
            }
        }
    }

    private function resolveLocalizedAttributes(ProductInterface $product, $attribute): void
    {
        $localeCodes = $this->localeProvider->getDefinedLocalesCodes();

        foreach ($localeCodes as $localeCode) {
            if (!$product->hasAttributeByCodeAndLocale($attribute->getCode(), $localeCode)) {
                $attributeValue = $this->createProductAttributeValue($attribute->getAttribute(), $localeCode);
                $product->addAttribute($attributeValue);
            }
        }
    }

    private function createProductAttributeValue(
        $attribute,
        string $localeCode,
    )
    {
        $attributeValue = $this->attributeValueFactory->createNew();
        $attributeValue->setAttribute($attribute);
        $attributeValue->setLocaleCode($localeCode);

        return $attributeValue;
    }
}