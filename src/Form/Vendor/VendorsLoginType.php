<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsLoginType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options): void
		{
			$builder
				->add('vendorSecurity', VendorsSecurityType::class)
				->add('submit', SubmitType::class, array(
					'label' => 'label.signin',
					'attr'  => array(
						'class' => 'btn btn-primary btn-block'
					)
				))
				->add('remember', CheckboxType::class, array(
					'mapped' => false,
					'label' => 'label.remember',
					'required' => false,
					'label_attr' => array(
						'class' => ''
					),
					'attr' => array(
						'id' => 'remember_me',
						'name' => '_remember_me',
						'class' => ''
					),
				))
				->add('token', HiddenType::class, array(
					'mapped' => false,
					'attr' => array(
						'name' => '_csrf_token',
					),
				));
		}

		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(array(
				'data_class'         => Vendors::class,
				'csrf_protection'    => true,
				'csrf_field_name'    => '_csrf_token',
				'csrf_token_id'      => '6cb546b7fb9e056773030920402e4172',
				'translation_domain' => 'vendor'
			));
		}
	}