<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('dateNaiss')
            ->add('nomPere',TextType::class)
            ->add('prenomPere',TextType::class)
            ->add('numtelPere',IntegerType::class)
            ->add('nomMere',TextType::class)
            ->add('prenomMere',TextType::class)
            ->add('numtelMere',IntegerType::class)
            ->add('groupe',EntityType::class,array(
                'class'         => 'AppBundle\Entity\Groupe',
                'choice_label'  => 'libelle',
                'choice_value'  => 'id',
                'multiple'      => false,
                'expanded'      => false,
                'required'      => true
            ))
            ->add('image', FileType::class, array('attr' => array('required' => true)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return 'FOS\UserBundle\Form\Type\EleveType';
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_eleve_type';
    }
}
