<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendor;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorEditType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
				->add('locale', TextType::class, array(
					'required' => false
				))
				->add('vendorSecurity', VendorSecurityType::class)
				->add('vendorEnGb', VendorEnGbType::class)
				->add('previous', SubmitType::class, array(
					'label' => 'label.previous',
					'attr' => array(
						'id' => 'next',
						'class' => 'btn btn-primary previous action-button-previous'
					)
				))
				->add('next', SubmitType::class, array(
					'label' => 'label.next',
					'attr' => array(
						'id' => 'next',
						'class' => 'btn btn-primary next action-button'
					)
				))
				->add('summit', SubmitType::class, array(
					'label' => 'mail.sku',
					'attr' => array(
						'class' => 'btn btn-primary submit'
					)
				))
			;

		}

		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
				'data_class' => Vendor::class,
				'attr' => array(
					'id' => 'msform'
				)
			]);
		}
	}
