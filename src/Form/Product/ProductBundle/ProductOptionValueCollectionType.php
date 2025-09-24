<?php

namespace App\Form\Product\ProductBundle;

use App\EntityInterface\Product\ProductOptionInterface;
use App\EntityInterface\Product\ProductOptionValueInterface;
use InvalidArgumentException;
use Webmozart\Assert\Assert;
use Symfony\Component\Form\AbstractType;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Exception\InvalidConfigurationException;

/**
 * This is special collection type, inspired by original 'collection' type
 * implementation, designed to handle option values assigned to object variant.
 * Array of OptionInterface objects should be passed as 'options' option to build proper
 * set of choice types with option values list.
 */
final class ProductOptionValueCollectionType extends AbstractType
{
    /**
     * @throws InvalidArgumentException
     * @throws InvalidConfigurationException
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->assertOptionsAreValid($options);

        foreach ($options['options'] as $i => $option) {
            if (!$option instanceof ProductOptionInterface) {
                throw new InvalidConfigurationException(sprintf('Each object passed as option list must implement "%s"', ProductOptionInterface::class));
            }

            $builder->add((string) $option->getCode(), ProductOptionValueChoiceType::class, [
                'label' => $option->getName() ?: $option->getCode(),
                'option' => $option,
                'data' => $this->getDefaultDataOption($option, $options['data']),
                'property_path' => '['.$i.']',
                'block_name' => 'entry',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'options' => null,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_value_collection';
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertOptionsAreValid($options): void
    {
        Assert::true(
            isset($options['options']) && is_iterable($options['options']),
            'array or (\Traversable and \ArrayAccess) of "SyliusInterface" must be passed to collection',
        );
    }

    private function getDefaultDataOption(ProductOptionInterface $option, Collection $data): ?ProductOptionValueInterface
    {
        foreach ($data as $defaultOption) {
            if ($defaultOption->getOption()->getCode() === $option->getCode()) {
                return $defaultOption;
            }
        }

        return null;
    }
}