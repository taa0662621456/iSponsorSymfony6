<?php

namespace App\Form\Attachment;

use App\Entity\Vendor\Vendor;
use App\Form\Vendor\VendorDocumentType;
use App\Form\Vendor\VendorMediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class AttachmentType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder,
//                              array $options): void
//    {
//        $builder->addEventListener(
//            FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//
//            $form = $event->getForm();
//            $request = Request::createFromGlobals();
//
//            if ($request->query->get('_route') == 'media') {
//                $form
//                    ->add('file', DropzoneType::class, [
//                        //TODO: добавить параметры дропзоны для медиа файлов
//                    ])
//                    ->add(
//                        'vendorsMediaAttachments', CollectionType::class,
//                        array(
//                            'entry_type'   => VendorMediaType::class,
//                            'data_class'   => null,
//                            'allow_add'    => true,
//                            'by_reference' => false,
//                            'allow_delete' => true,
//                            'prototype'    => true
//                        )
//                    );
//            } elseif ($request->query->get('_route') == 'docs') {
//                $form
//                    ->add('file', DropzoneType::class, [
//                        //TODO: добавить параметры дропзоны для файлов документов
//                    ])
//                    ->add(
//                        'vendorsDocumentAttachments', CollectionType::class,
//                        array(
//                            'entry_type'   => VendorDocumentType::class,
//                            'data_class'   => null,
//                            'allow_add'    => true,
//                            'by_reference' => false,
//                            'allow_delete' => true,
//                            'prototype'    => true
//                        )
//                    );
//            } else {
//                //TODO: Error Exception
//                dump($request->query->get('_route'));
//            }
//
//
//        }
//        );
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults(
//            [
//                'data_class'         => Vendor::class,
//                'translation_domain' => 'vendor'
//            ]
//        );
//    }
}
