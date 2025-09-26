<?php


	namespace App\Form\Vendor;

	use App\Entity\Vendor\VendorEnUS;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Intl\Countries;
    use Symfony\Component\Intl\Currencies;
    use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorEnGbType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{

			$countries = Countries::getNames();
			$currencies = Currencies::getNames();
			$builder
				->add('vendorFirstName', TextType::class, array(
					'label' => 'label.first.name',
					'label_attr' => array(
						'class' => 'sr-only',
					),
					'required' => true,
					'attr' => array(
						'id' => 'vendorFirstName',
						'class' => '',
						'placeholder' => 'Enter Your first name',
						'tabindex' => '101',
						'autofocus' => true
					)
				))
				->add('vendorLastName', TextType::class, array(
					'label' => 'label.last.name',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => true,
					'attr' => array(
						'id' => 'lastName',
						'class' => '',
						'placeholder' => 'Enter Your last name',
						'tabindex' => '102',
						'autofocus' => false
					),
				))
				->add('vendorMiddleName', TextType::class, array(
					'label' => 'label.middle.name',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'middleName',
						'class' => '',
						'placeholder' => 'Enter Your middle name',
						'tabindex' => '103',
						'autofocus' => false
					),
				))
				->add('vendorPhone', TelType::class, array(
					'label' => 'label.phone.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'phoneNumber',
						'class' => '',
						'placeholder' => 'Enter Your phone number',
						'tabindex' => '201',
						'autofocus' => false
					),
				))
				->add('vendorSecondPhone', TelType::class, array(
					'label' => 'label.second_phone.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'phoneSecond',
						'class' => '',
						'placeholder' => 'Enter Your second phone number',
						'tabindex' => '202',
						'autofocus' => false
					),
				))
				->add('vendorFax', TelType::class, array(
					'label' => 'label.fax.number',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'faxNumber',
						'class' => '',
						'placeholder' => 'Enter Your fax number',
						'tabindex' => '203',
						'autofocus' => false
					),
				))
				->add('vendorAddress', TextType::class, array(
					'label' => 'label.first.address',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => '',
						'placeholder' => 'Enter Your address',
						'tabindex' => '301',
						'autofocus' => false
					),
				))
				->add('vendorSecondAddress', TextType::class, array(
					'label' => 'label.second.address',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => '',
						'placeholder' => 'Enter Your second address',
						'tabindex' => '302',
						'autofocus' => false
					),
				))
				->add('vendorCity', TextType::class, array(
					'label' => 'label.city',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'firstAddress',
						'class' => '',
						'placeholder' => 'Enter Your city',
						'tabindex' => '401',
						'autofocus' => false
					),
				))
				//->add('stateId')
				->add('vendorCountryId', ChoiceType::class, array(
					//'choices' => array_flip($countries),
					'choices' => $countries,
					'label'=>'Country',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'country',
						'class' => '',
						'placeholder' => 'Enter Your country name',
						'tabindex' => '403',
						'autofocus' => false
					)
				))
				->add('vendorZip', TextType::class, array(
					'label' => 'label.zip',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'required' => false,
					'attr' => array(
						'id' => 'zip',
						'class' => '',
						'placeholder' => 'Enter Your zip-code',
						'tabindex' => '404',
						'autofocus' => false
					)
				))
				->add('vendorCurrency', ChoiceType::class, array(
					//'choices' => array_flip($currencies),
					'choices' => $countries,
					'label'=>'label.currency',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'currency',
						'class' => '',
						'placeholder' => 'Enter Your main currency',
						'tabindex' => '501',
						'autofocus' => false
					)
				))
				->add('vendorAcceptedCurrencies', ChoiceType::class, array(
					//'choices' => array_flip($currencies),
					'choices' => $currencies,
					'label'=>'label.currency',
					'label_attr' => array(
						'class' => ''
					),
					'required' => false,
					'attr' => array(
						'id' => 'accepted_currency',
						'class' => '',
						'placeholder' => 'Enter Your accepted currency',
						'tabindex' => '502',
						'autofocus' => false
					)
				))
				/*
				->add('vendorParams')
				->add('metaRobot')
				->add('metaAuthor')
				->add('createdBy')
				*/
			;
		}

		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
				'data_class'         => VendorEnUS::class,
				'translation_domain' => 'vendor',
                'attr' => [
                    'class' => 'needs-validation',
                    'novalidate' => null,
                ]
			]);
		}
	}
