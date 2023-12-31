<?php

namespace App\Form\Product\AttributeType\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

abstract class AttributeType extends AbstractResourceType
{
    public function __construct(
        string $dataClass,
        array $validationGroups,
        protected string $attributeTranslationType,
        protected FormTypeRegistryInterface $formTypeRegistry,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => $this->attributeTranslationType,
                'label' => 'form.attribute.translations',
            ])
            ->add('type', AttributeTypeChoiceType::class, [
                'label' => 'form.attribute.type',
                'disabled' => true,
            ])
            ->add('translatable', CheckboxType::class, ['label' => 'form.attribute.translatable']);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $attribute = $event->getData();

            if (!$attribute instanceof AttributeInterface) {
                return;
            }

            if (!$this->formTypeRegistry->has($attribute->getType(), 'configuration')) {
                return;
            }

            $event->getForm()->add('configuration', $this->formTypeRegistry->get($attribute->getType(), 'configuration'), [
                'auto_initialize' => false,
                'label' => 'form.attribute_type.configuration',
            ]);
        });
    }
}
