<?php

namespace Gestion_Abs_IUTBM_Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbscenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('debutAbs', DateTimeType::class, array(
                'label' => 'Début de l\'absence',
                'attr' => array(
                    'class' => 'form-control datetime'
                )
            ))
            ->add('finAbs', DateTimeType::class, array(
                'label' => 'Fin de l\'absence',
                'attr' => array(
                    'class' => 'form-control datetime'
                )
            ))
            ->add('fichJustificatif', DateTimeType::class, array(
                'label' => 'Justificatif de l\'absence',
                'attr' => array(
                    'class' => 'filestyle'
                )
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion_Abs_IUTBM_Bundle\Entity\Abscence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestion_abs_iutbm_bundle_abscence';
    }


}
