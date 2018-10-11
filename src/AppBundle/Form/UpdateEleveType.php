<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UpdateEleveType extends AbstractType
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
            ->add('image', FileType::class, array('attr' => array('required' => true),'data_class' => null))
            ->add('update', SubmitType::class, array('label' => 'Modifier les informations de l"éléve',
                'attr' => array(
        'class' => 'btn cyan waves-effect waves-light')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Eleve',
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_update_eleve_type';
    }
}
