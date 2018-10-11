<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdatePaiementType extends AbstractType
{
    const Janvier = 'Janvier';
    const Fevrier = 'Février';
    const Mars = 'Mars';
    const Avril = 'Avril';
    const Mai = 'Mai';
    const Juin = 'Juin';
    const Juillet = 'Juillet';
    const Aout = 'Août';
    const Septembre = 'Septembre';
    const Octobre = 'Octobre';
    const Novembre = 'Novembre';
    const Decembre = 'Décembre';
    const Trimestre1 = 'Janvier , Février , Mars';
    const Trimestre2 = 'Avril , Mai , Juin';
    const Trimestre3 = 'Juillet , Août , Septembre';
    const Trimestre4 = 'Octobre , Novembre , Décembre';
    const Annuelle = 'Janvier , Février , Mars , Avril , Mai , Juin , Juillet , Août , Septembre , Octobre , Novembre , Décembre ';
    const  AnneeScolaire = 'Janvier , Février , Mars , Avril , Mai , Juin';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('montant',TextType::class)
            ->add('mois',ChoiceType::class, [
                'choices'  => [
                    'Janvier' => self::Janvier,
                    'Fevrier' => self::Fevrier,
                    'Mars' => self::Mars,
                    'Avril' => self::Avril,
                    'Mai' => self::Mai,
                    'Juin' => self::Juin,
                    'Juillet' => self::Juillet,
                    'Aout' => self::Aout,
                    'Septembre' => self::Septembre,
                    'Octobre' => self::Octobre,
                    'Novembre' => self::Novembre,
                    'Decembre' => self::Decembre,
                    'Trimestre1' => self::Trimestre1,
                    'Trimestre2' => self::Trimestre2,
                    'Trimestre3' => self::Trimestre3,
                    'Trimestre4' => self::Trimestre4,
                    'Annuelle' => self::Annuelle,
                    'AnneeScolaire' => self::AnneeScolaire],
                'expanded'  => true,
                'multiple'  => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Paiement',
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_update_paiement_type';
    }
}
