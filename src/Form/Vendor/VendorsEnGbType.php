<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\VendorsEnGb;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Intl\Intl;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsEnGbType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$countries = Intl::getRegionBundle()->getCountryNames();
			$currencies = Intl::getCurrencyBundle()->getCurrencyNames();
			$builder
				->add('firstName', null, array(
					'label_attr' => array(
						'class' => 'sr-only',
					),
					'required' => true,
					'attr' => array(
						'id' => 'firstName',
						'class' => 'form-control',
						'placeholder' => 'Enter Your first name',
						'tabindex' => '101',
						'autofocus' => true
					),
				))
				->add('lastName', null, array(
					'label' => 'label.last.name',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => true,
					'attr' => array(
						'id' => 'lastName',
						'class' => 'form-control',
						'placeholder' => 'Enter Your last name',
						'tabindex' => '102',
						'autofocus' => false
					),
				))
				->add('middleName', null, array(
					'label' => 'label.middle.name',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'middleName',
						'class' => 'form-control',
						'placeholder' => 'Enter Your middle name',
						'tabindex' => '103',
						'autofocus' => false
					),
				))
				->add('phone', null, array(
					'label' => 'label.phone.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'phoneNumber',
						'class' => 'form-control',
						'placeholder' => 'Enter Your phone number',
						'tabindex' => '201',
						'autofocus' => false
					),
				))
				->add('phoneSecond', null, array(
					'label' => 'label.second_phone.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'phoneSecond',
						'class' => 'form-control',
						'placeholder' => 'Enter Your second phone number',
						'tabindex' => '202',
						'autofocus' => false
					),
				))
				->add('fax', null, array(
					'label' => 'label.fax.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'faxNumber',
						'class' => 'form-control',
						'placeholder' => 'Enter Your fax number',
						'tabindex' => '203',
						'autofocus' => false
					),
				))
				->add('address', null, array(
					'label' => 'label.first.address',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => 'form-control',
						'placeholder' => 'Enter Your address',
						'tabindex' => '301',
						'autofocus' => false
					),
				))
				->add('addressSecond', null, array(
					'label' => 'label.second.address',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => 'form-control',
						'placeholder' => 'Enter Your second address',
						'tabindex' => '302',
						'autofocus' => false
					),
				))
				->add('city', null, array(
					'label' => 'label.city',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => 'form-control',
						'placeholder' => 'Enter Your city',
						'tabindex' => '401',
						'autofocus' => false
					),
				))
				//->add('stateId')
				->add('countryId', ChoiceType::class, array(
					//'choices' => array_flip($countries),
					'choices' => Intl::getRegionBundle()->getCountryNames(),
					'label'=>'Country',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'country',
						'class' => 'form-control',
						'placeholder' => 'Enter Your country name',
						'tabindex' => '403',
						'autofocus' => false
					),
				))
				->add('zip', TextType::class, array(
					'label' => 'label.zip',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'zip',
						'class' => 'form-control',
						'placeholder' => 'Enter Your zip-code',
						'tabindex' => '404',
						'autofocus' => false
					),
				))
				->add('vendorCurrency', ChoiceType::class, array(
					//'choices' => array_flip($currencies),
					'choices' => Intl::getRegionBundle()->getCountryNames(),
					'label'=>'label.currency',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'currency',
						'class' => 'form-control',
						'placeholder' => 'Enter Your main currency',
						'tabindex' => '501',
						'autofocus' => false
					),
				))
				->add('vendorAcceptedCurrencies', ChoiceType::class, array(
					//'choices' => array_flip($currencies),
					'choices' => Intl::getCurrencyBundle()->getCurrencyNames(),
					'label'=>'label.currency',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'accepted_currency',
						'class' => 'form-control',
						'placeholder' => 'Enter Your accepted currency',
						'tabindex' => '502',
						'autofocus' => false
					),
				))
				/*
				->add('vendorParams')
				->add('metaRobot')
				->add('metaAuthor')
				->add('createdOn')
				->add('createdBy')
				->add('modifiedOn')
				->add('modifiedBy')
				->add('lockedOn')
				->add('lockedBy')
				*/
			;
		}

		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
				'data_class' => VendorsEnGb::class,
			]);
		}
	}
