<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Artgris\Bundle\MediaBundle\Form\Type\MediaCollectionType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        /*
->add('Photos', FileType::class, [
                'label' => 'Photo (jpg ou jpeg)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the image
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '8000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            // ...
            //, FileType::class, [    'label' => 'Photos (image jpg ou jpeg)',   'multiple' => true  ])
            // ->add('Photos', FileType::class, ['label' => 'Photos (image jpg ou jpeg)'])

        */
        $builder
            ->add('Title')
            ->add('Brand')
            ->add('Description')
            
            ->add('URLaffiliation')
            ->add('Image', MediaType::class, [
                'conf' => 'default'
            ])
            ->add('Gallery', MediaCollectionType::class, [
                'conf' => 'default',
                'entry_options' => [
                    'display_file_manager' => true
                ]
            ])
            ->add('Category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $cr)
                {
                    return $cr->findByParentNull();
                },
                // uses the Category.name property as the visible option string
                'choice_label' => 'name',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
