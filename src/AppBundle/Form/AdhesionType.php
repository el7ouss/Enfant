<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class, array(
                'choices' => array(
                    'Normal' => 'Normal',
                    'Spécifique' => 'Spécifique',
                )))
            ->add('typePaiement',ChoiceType::class, array(
                'choices' => array(
                    'Annuel' => 'Annuel',
                    'Trimestriel' => 'Trimestriel',
                    'Mensuel' => 'Mensuel',
                )))
            ->add('montant',IntegerType::class)
            ->add('enable', ChoiceType::class, array(
                'label' => 'Adhesion valide ou non valide ?',
                'choices' => array('Valide' => 1, 'Non valide' => 0),
                'expanded' => true,
                'multiple' => false,
                'required' => true
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Adhesion',
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_adhesion_type';
    }
}
