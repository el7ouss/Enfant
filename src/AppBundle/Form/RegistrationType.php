<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CIN')
            ->add('nom')
            ->add('prenom')
            ->add('dateNaiss')
            ->add('numtel')
            ->add('roles', ChoiceType::class, array(
                        'attr'  =>  array('class' => 'form-control'),
                        'choices' =>
                            array
                            (
                                'ROLE_RESPONSABLE' => 'ROLE_RESPONSABLE',
                            ) ,
                        'multiple' => true,
                        'required' => true,
                    )
                )
            ->add('image', FileType::class, array('attr' => array('required' => true)));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}

