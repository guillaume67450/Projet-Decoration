<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Keyword;
use App\Entity\CategoryArt;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Tapez un titre pour l'article"))
            ->add('slug', TextType::class, $this->getConfiguration("Adresse web", "Tapez l'adresse web (automatique)", [ 
                'required' => false
                ])
            )
            ->add('content', TextareaType::class, $this->getConfiguration("Contenu de l'article", "Saisissez ici votre article"))
            ->add('featured_image', TextType::class, $this->getConfiguration("Image", "Entrez l'adresse de l'image"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
