<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CIN',IntegerType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('dateNaiss')
            ->add('numtel',TelType::class)
            ->add('image', FileType::class, array('attr' => array('required' => true)));
    }

    public function getParent()

    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_profile';
    }

    public function getName()

    {
        return $this->getBlockPrefix();
    }
}
