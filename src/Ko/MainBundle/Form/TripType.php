<?php

namespace Ko\MainBundle\Form;

use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateBegin',DateType::class ,array(
                'required' => true,
                'label' => 'Date de début',
                'widget' => 'single_text',
                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,
                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'MM/dd/yyyy',
            ))
            ->add('dateEnd',DateType::class,array(
                'required' => true,
                'label' => 'Date limite',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'MM/dd/yyyy',
            ))
            ->add('hourOpen',TimeType::class,array(
                'required' => true,
                'label' => 'Heure d ouverture',
            ))
            ->add('hourClose',TimeType::class,array(
                'required' => true,
                'label' => 'Heure de fermeture'
            ))
            ->add('sizeCar',ChoiceType::class,array(
                'required' => true,
                'label' => 'Taille du colis',
                'choices'  => array(
                    'Petit' => 0,
                    'Moyen' => 1,
                    'Gros' => 2,
                )
            ))
            ->add('addressDeparture',PlaceAutocompleteType::class,array(
                'required' => true,
                'label' => 'Adresse de départ',
                'components' => [AutocompleteComponentType::COUNTRY => 'fr'],
                'api' => false,
                'attr' => ['class' => 'form-control'],

            ))
            ->add('addressArrival',PlaceAutocompleteType::class,array(
                'required' => true,
                'label' => 'Adresse d arrivée',
                'components' => [AutocompleteComponentType::COUNTRY => 'fr'],
                'api' => false,
                'attr' => ['class' => 'form-control'],

            ))
            ->add('typeProduct',TextType::class,array(
                'required' => true,
                'label' => 'Type de Produit'
            ))
            ->add('description',TextareaType::class,array(
                'required' => true,
                'label' => 'Description du colis'
            ))
            ->add('Ajouter',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ko\MainBundle\Entity\Trip'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ko_mainbundle_trip';
    }


}
