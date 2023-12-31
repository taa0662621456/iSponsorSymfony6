<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductPropertyInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

#[ORM\Entity]
class ProductProperty extends RootEntity implements ObjectInterface, ProductPropertyInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'product_weight', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private NumberType|float|null $productWeight;

    #[ORM\Column(name: 'product_weight_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productWeightUom = null;

    #[ORM\Column(name: 'product_width', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private NumberType|float|null $productWidth;

    #[ORM\Column(name: 'product_width_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productWidthUom = null;

    #[ORM\Column(name: 'product_height', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private float $productHeight;

    #[ORM\Column(name: 'product_height_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productHeightUom = null;

    #[ORM\Column(name: 'product_length', type: 'float', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
    private float $productLength;

    #[ORM\Column(name: 'product_length_uom', type: 'integer', nullable: true)]
    private NumberType|float|null $productLengthUom = null;
}
