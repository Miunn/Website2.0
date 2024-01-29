<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\PostCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'posts.add.placeholder.title',
                ],
                'row_attr' => [
                    'class' => 'title-row'
                ]
            ])
            ->add('date', DateType::class, [
                'label' => false,
                'widget' => 'choice',
                'input' => 'datetime_immutable',
                'data' => date_create_immutable(),
                'format' => 'dd-MMM-yyyy',
                'years' => range(date('Y')-50, date('Y')+50),
                'row_attr' => [
                    'class' => 'date-row'
                ]
            ])
            ->add('link', UrlType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'posts.add.placeholder.link',
                ]
            ])
            ->add('categories', CollectionType::class, [
                'label' => 'posts.add.placeholder.categories',
                'entry_type' => PostCategoryFormType::class,
                "entry_options" => [
                    'label' => false,
                    'attr' => [
                        'class' => 'post-tag'
                    ]
                ],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'posts.add.placeholder.description',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}