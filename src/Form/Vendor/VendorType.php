<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('locale', HiddenType::class, array(
            	'required' => false
			))
        ;

    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'translation_domain' => 'button',
            'data_class' => Vendor::class,
        ]);
    }
}
