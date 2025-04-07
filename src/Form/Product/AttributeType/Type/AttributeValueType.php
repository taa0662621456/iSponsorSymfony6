<?php

namespace App\Form\Product\AttributeType\Type;

use App\Form\Local\LocaleChoiceType;
use Composer\Repository\RepositoryInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AttributeValueType extends AbstractResourceType
{
    public function __construct(
        string $dataClass,
        array $validationGroups,
        protected string $attributeChoiceType,
        protected RepositoryInterface $attributeRepository,
        protected RepositoryInterface $localeRepository,
        protected FormTypeRegistryInterface $formTypeRegistry,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localeCode', LocaleChoiceType::class)
            ->add('attribute', $this->attributeChoiceType)
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $attributeValue = $event->getData();

                if (!$attributeValue instanceof AttributeValueInterface) {
                    return;
                }

                $attribute = $attributeValue->getAttribute();
                if (null === $attribute) {
                    return;
                }

                $localeCode = $attributeValue->getLocaleCode();

                $this->addValueField($event->getForm(), $attribute, $localeCode);
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $attributeValue = $event->getData();

                if (!isset($attributeValue['attribute'])) {
                    return;
                }

                $attribute = $this->attributeRepository->findOneBy(['code' => $attributeValue['attribute']]);
                if (!$attribute instanceof AttributeInterface) {
                    return;
                }

                $this->addValueField($event->getForm(), $attribute);
            });

        $builder->get('localeCode')->addModelTransformer(
            new ReversedTransformer(new ResourceToIdentifierTransformer($this->localeRepository, 'code')),
        );
    }

    protected function addValueField(
        FormInterface $form,
        AttributeInterface $attribute,
        string $localeCode = null,
    ): void {
        $form->add('value', $this->formTypeRegistry->get($attribute->getType(), 'default'), [
            'auto_initialize' => false,
            'configuration' => $attribute->getConfiguration(),
            'label' => $attribute->getName(),
            'locale_code' => $localeCode,
        ]);
    }
}
