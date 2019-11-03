<?php
	declare(strict_types=1);

	namespace App\Form\Vendor;

	use App\Entity\Vendor\Vendors;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormEvent;
	use Symfony\Component\Form\FormEvents;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class VendorsAttachmentsType
		extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder,
								  array $options): void
		{
			$builder->addEventListener(
				FormEvents::PRE_SET_DATA, function (FormEvent $event) {

				$form = $event->getForm();
				$request = Request::createFromGlobals();

				if ($request->query->get('_route') == 'media') {
					$form->add(
						'vendorsMediaAttachments', CollectionType::class,
						array(
							'entry_type'   => VendorsMediaAttachmentsType::class,
							'data_class'   => null,
							'allow_add'    => true,
							'by_reference' => false,
							'allow_delete' => true,
							'prototype'    => true
						)
					);
				} elseif ($request->query->get('_route') == 'docs') {
					$form->add(
						'vendorsDocumentAttachments', CollectionType::class,
						array(
							'entry_type'   => VendorsDocumentAttachmentsType::class,
							'data_class'   => null,
							'allow_add'    => true,
							'by_reference' => false,
							'allow_delete' => true,
							'prototype'    => true
						)
					);
				} else {
					//TODO: Error Exception
					dump($request->query->get('_route'));
				}


			}
			);
		}

		public function configureOptions(OptionsResolver $resolver): void
		{
			$resolver->setDefaults(
				[
					'data_class'         => Vendors::class,
					'translation_domain' => 'vendor'
				]
			);
		}
	}
