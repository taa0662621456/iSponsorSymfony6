<?php


namespace App\CoreBundle\Form\Type\Taxon;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class TaxonImageType extends ImageType
{
    public function getBlockPrefix(): string
    {
        return 'taxon_image';
    }
}
