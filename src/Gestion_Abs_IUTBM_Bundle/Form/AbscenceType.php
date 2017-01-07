<?php

namespace Gestion_Abs_IUTBM_Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AbscenceType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('finAbs', DateTimeType::class, array(
                'label' => 'Fin de l\'absence',
                'widget' => 'single_text',
                'format' => 'd/m/Y (H:i)',
                'attr' => array(
                    'class' => 'form-control datetime',
                    'value' => ""
                ),
                'constraints' => array(
                    new Assert\NotBlank(['message' => 'Ce champ n\'est pas remplit']),
                    new Assert\DateTime([
                        'format' => 'd/m/Y (H:i)',
                        'message' => 'Mauvais format ( j/m/a (H:i) )'
                    ])
                )
            ))
            ->add('fileFichJustificatif', VichFileType::class, array(
                'label' => 'Justificatif de l\'absence',
                'attr' => array(
                    'class' => 'filestyle'
                ),
                'constraints' => array(
                    new Assert\NotBlank(['message' => 'Ce champ n\'est pas remplit']),
                    new Assert\File([
                        'maxSize' => '8Mi',
                        'maxSizeMessage' => 'Le fichier est trop lourd, il ne doit pas dépasser 8Mi',
                        'mimeTypes' => ['image/png', 'image/jpeg'],
                        'mimeTypesMessage' => 'Les formats autorisés sont .png et .jpeg'
                    ])
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
