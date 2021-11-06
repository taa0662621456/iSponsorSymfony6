<?php
declare(strict_types=1);

namespace App\Form\Project;

use App\Tool\ProjectTagTransformer;
use App\Repository\Tag\TagRepository;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ProjectTagType extends AbstractType
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // The Tags collection must be transformed into a comma separated string.
            // We could create a custom transformer to do Collection <-> string in one step,
            // but here we're doing the transformation in two steps (Collection <-> array <-> string)
            // and reuse the existing CollectionToArrayTransformer.
            ->addModelTransformer(new CollectionToArrayTransformer(), true)
            ->addModelTransformer(new ProjectTagTransformer($this->tags), true)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['tags'] = $this->tags->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent():?string
    {
        return TextType::class;
    }
}
