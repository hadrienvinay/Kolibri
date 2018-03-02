<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class, array(
                'label' => 'Prénom',
            ))
            ->add('lastName',TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('picture',FileType::class, array(
                'label' => 'Image',
                'data_class' => null,
                'required' => false,
            ))
            ->add('phone',TextType::class, array(
                'label' => 'Télephone',
            ))
            ->add('description',TextType::class, array(
                'label' => 'Description',
            ))
            ->add('ajouter',SubmitType::class);

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
