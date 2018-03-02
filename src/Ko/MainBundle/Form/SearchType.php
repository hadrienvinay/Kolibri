<?php

namespace Ko\MainBundle\Form;

use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('depart',PlaceAutocompleteType::class,array(
            'required' => true,
            'label' => 'Adresse de départ',
            'components' => [AutocompleteComponentType::COUNTRY => 'fr'],
            'api' => false,
            'attr' => ['class' => 'form-control'],

        ))
            ->add('arrivee',PlaceAutocompleteType::class,array(
                'required' => true,
                'label' => 'Adresse d arrivée',
                'components' => [AutocompleteComponentType::COUNTRY => 'fr'],
                'api' => false,
                'attr' => ['class' => 'form-control'],

            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'ko_main_bundle_search_type';
    }
}
