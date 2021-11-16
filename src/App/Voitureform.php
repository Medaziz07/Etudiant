<?php

namespace App\App;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class Voitureform extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option){
        $builder->add('serie', TextType::class)
            ->add('dateMiseEnMarche', TextType::class)
            ->add('modele', TextType::class);
    }
    public function getName(){
        return 'voiture';
    }

}