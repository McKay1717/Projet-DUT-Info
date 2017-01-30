<?php

namespace Gestion_Abs_IUTBM_Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AbscenceAddType extends AbstractType{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('debutAbs', DateTimeType::class, array(
                'label' => 'Debut de l\'absence',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy (HH:mm)',
                'attr' => array(
                    'placeholder' => 'ex : 12/10/2017 (12:00)',
                    'class' => 'form-control ',
                    'value' => "",
                )
            ))
            ->add('finAbs', DateTimeType::class, array(
                'label' => 'Fin de l\'absence',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy (HH:mm)',
                'attr' => array(
                    'placeholder' => 'ex : 12/10/2017 (12:00)',
                    'class' => 'form-control ',
                    'value' => "",
                )
            ))
            ->add('justificatif', JustificatifType::class)
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
    public function getBlockPrefix(){
        return 'gestion_abs_iutbm_bundle_abscence';
    }

}