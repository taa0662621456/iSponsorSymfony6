<?php

namespace App\Form\Product\AttributeType\Configuration;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\FormEvent;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\ServiceInterface\Locale\LocaleProviderServiceInterface;
use function array_key_exists;
use function is_int;

class SelectAttributeChoicesCollectionType extends AbstractType
{
    private string $defaultLocaleCode;

    public function __construct(LocaleProviderServiceInterface $localeProvider)
    {
        $this->defaultLocaleCode = $localeProvider->getDefaultLocaleCode();
    }

    /**
     * @psalm-suppress InvalidScalarArgument Some weird magic going on here, not sure about refactor
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (null !== $data) {
                $fixedData = [];
                foreach ($data as $key => $values) {
                    if (!is_int($key)) {
                        $fixedData[$key] = $this->resolveValues($values);

                        continue;
                    }

                    if (!array_key_exists($this->defaultLocaleCode, $values)) {
                        continue;
                    }

                    $key = (string) $key;
                    $newKey = $this->getUniqueKey();
                    $fixedData[$newKey] = $this->resolveValues($values);

                    if ($form->offsetExists($key)) {
                        $type = $form->get($key)->getConfig()->getType()->getInnerType()::class;
                        $options = $form->get($key)->getConfig()->getOptions();

                        $form->remove($key);
                        $form->add($newKey, $type, $options);
                    }
                }

                $event->setData($fixedData);
            }
        });
    }

    public function getParent(): string
    {
        return CollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'select_attribute_choices_collection';
    }

    private function getUniqueKey(): string
    {
        return Uuid::uuid1()->toString();
    }

    private function resolveValues(array $values): array
    {
        $fixedValues = [];
        foreach ($values as $locale => $value) {
            if ('' !== $value && null !== $value) {
                $fixedValues[$locale] = $value;
            }
        }

        return $fixedValues;
    }
}
