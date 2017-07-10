<?php

namespace Ko\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',TextType::class, array(
                'required' => true,
                'label' => 'Desciption'
            ))
            ->add('date',DateType::class, array(
                'required' => true,
                'label' => 'Date'
            ))
            ->add('startPlace',TextType::class, array(
                'required' => true,
                'label' => 'Départ'
    ))
            ->add('arrivalPlace',TextType::class, array(
                'required' => true,
                'label' => 'Arrivée'
            ))

            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ko\ProjectBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ko_projectbundle_annonce';
    }


}
