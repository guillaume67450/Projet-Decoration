<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Artgris\Bundle\MediaBundle\Form\Type\MediaCollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use App\Form\ApplicationType;

class ProductType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, $this->getConfiguration("Titre", "saisir le titre du produit"))
            ->add('Brand', TextType::class, $this->getConfiguration("Marque" , "saisir la marque du produit"))
            ->add('Description', TextAreaType::class, $this->getConfiguration("Description" , "saisir la description du produit"))
            ->add('Price', NumberType::class, $this->getConfiguration("Prix" , "saisir le prix du produit"))
            ->add('URLaffiliation', UrlType::class, $this->getConfiguration("URL affiliation" , "saisir url affialiation du produit"))
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
                'query_builder' => function (CategoryRepository $cr) {
                    return $cr->findByParentNotNull();
                },
                // uses the Category.name property as the visible option string
                'choice_label' => 'name',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
