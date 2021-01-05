<?php

namespace App\Form;

use App\Entity\Navire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\AisShipType;

class NavireType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numImo', TextType::class)
                ->add('nom', TextType::class)
                ->add('numMMSI', TextType::class)
                ->add('indicatifAppel', TextType::Class)
                ->add('longueur')                   
                ->add('largeur')
                ->add('triantdeau')
                ->add('leType', EntityType::class, [
                    'class' => AisShipType::class,
                    'choice_label' => 'libelle',
                    'expanded' => false,
                    'multiple' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Navire::class,
        ]);
    }

}
