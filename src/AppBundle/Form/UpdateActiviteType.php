<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UpdateActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class)
            ->add('nbHeure',IntegerType::class)
            ->add('update', SubmitType::class, array('label' => 'Modifier l"activité', 'attr' => array(

                'class' => 'btn cyan waves-effect waves-light')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activite',
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_update_activite_type';
    }
}
