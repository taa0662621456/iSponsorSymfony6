<?php
/*
 * TODO: создаем универсальную, типовую форму для работы с основными объектами проекта
 * нужно обратить внимание на все TODO
 * добавить в конструктор обработку всех $this
 * при этом конструктор становится типовым, что может привести нас к выделению отдельного класа с его содержанием
 */

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectType extends AbstractType
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var string
     */
    private $object;
    private $crud;
    /**
     * @var false|string|string[]|null
     */
    private $route;
    /**
     * @var string
     */
    private $type;
    /**
     * @var false|string|string[]|null
     */
    private $path;
    /**
     * @var string
     */
    private $objectEnGb;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $object = (string)ucfirst(current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2)));
        $this->object = (string)ucfirst(current(explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2)));
        $this->objectEnGb = '\\App\\Entity\\' . $object . '\\' . $object . 'sEnGbType'; // TODO: не продумано для Entity
        $crud = explode('_', $requestStack->getMasterRequest()->attributes->get('_route'), 2);
        $this->crud = $crud[1];
        $this->route = mb_strtolower($object);
        $this->type = '\\App\\src\\Form\\' . $object . '\\' . $object . 'Type';
        $this->path = mb_strtolower($object . '/' . $object . '/' . $crud[1] . '.html.twig');
        // TODO: не продумана структура папок, в частности не клеится с Categories (окончание не "y")
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                $builder
                    ->create('step-1', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-1'
                        ),
                    ))
                    ->add('id', HiddenType::class)
                    ->add('objectCategory', EntityType::class, array(
                        'class' => $this->objectCategories, //TODO: добавить в конструктор
                        'required' => true,
                        'multiple' => false,
                        'choice_label' => 'id'
                    ))
            )
            ->add('projectEnGb', $this->objectEnGb, array(
                    'label' => false,
                    'row_attr' => array(
                        'id' => 'object')
                )
            )
            ->add(
                $builder
                    ->create('step-4', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-5'
                        ),
                    ))
                    ->add('projectAttachments', CollectionType::class, array(
                            'entry_type' => $this->objectAttachmentsType, //TODO: добавить в конструктор
                            'label' => 'object.attachment.label',
                            'translation_domain' => 'object',
                            'entry_options' => array('label' => false),
                            'required' => false,
                            //'empty_data' => true,
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true,
                        )
                    )
            )
            ->add(
                $builder
                    ->create('step-6', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'row_attr' => array(
                            'id' => 'step-6'
                        ),
                    ))
                    ->add('objectTags', $this->objectTagsType, array( //TODO: добавить в конструктор
                            'required' => false,
                        )
                    )
            )
            ->add(
                $builder
                    ->create('step', FormType::class, array(
                        'inherit_data' => true,
                        'label' => false,
                        'attr' => array(
                            'class' => 'btn-group'
                        )
                    ))
                    ->add('previous', ButtonType::class, array(
                            'label' => 'label.previous',
                            'attr' => array(
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-prev'
                            )
                        )
                    )
                    ->add('next', ButtonType::class, array(
                            'label' => 'label.next',
                            'attr' => array(
                                'id' => 'next',
                                'class' => 'btn btn-primary sw-btn-next'
                            )
                        )
                    )
            )
            ->add('submit', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-primary submit'
                )
            ))
            //$languages = $request->getLanguages();
            //$this->getUser()->getCulture();
            //->add('langType', ChoiceType::class, array(
            //					//'choices' => array_flip($cultures),
            //					'choices' => Intl::getRegionBundle()->getCountryNames(),
            //					'label'=>'label.languages',
            //					'label_attr' => array(
            //						'class' => ''
            //					),
            //					'value' =>	$this->getUser()->getCulture();
            //					'required' => false,
            //					'attr' => array(
            //						'id' => 'languages',
            //						'class' => 'form-control',
            //						'placeholder' => 'Enter Your country name',
            //						'autofocus' => true
            //					), )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => $this->object,
            'translation_domain' => $this->object,
            'method' => 'POST',
            'attr' => array(
                'id' => 'object'
            )
        ]);
    }
}
