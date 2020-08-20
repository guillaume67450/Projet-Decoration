<?php

namespace App\Form;

use App\Entity\Comment;
use App\Form\ApplicationType;
use Doctrine\DBAL\Types\BooleanType as TypesBooleanType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CommentType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, $this->getConfiguration("Contenu du commentaire", "Saisissez votre commentaire ici"))
            //->add('active')
            //->add('created_at')
            ->add('rgpd', CheckboxType::class,  $this->getConfiguration("RGPD", "Accepter les termes d'utilisation conformément à la loi"))
            //->add('user')
            //->add('article')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
