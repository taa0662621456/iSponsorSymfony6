<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsAddType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
				->add('vendorSecurity', VendorsSecurityType::class)
				->add('vendorEnGb', VendorsEnGbType::class)
				->add(
					'slug', TextType::class, array(
						'label'      => 'label.slug',
						'label_attr' => array(
							'class' => 'sr-only'
						),
						'required'   => false
					)
				)
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
				'data_class' => Vendors::class,
				'attr' => array(
					'id' => 'msform'
				)
			]);
		}
	}
