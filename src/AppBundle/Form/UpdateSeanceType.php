<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UpdateSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jours',ChoiceType::class, array(
                'choices' => array(
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Dimanche' => 'Dimanche',),
                'expanded' => true,
                'multiple' => false,
                'required' => true))
            ->add('dateStart',TextType::class)
            ->add('dateEnd',TextType::class)
            ->add('update', SubmitType::class, array('label' => 'Modifier la séance', 'attr' => array(

                'class' => 'btn cyan waves-effect waves-light')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Seance',
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_update_seance_type';
    }
}
