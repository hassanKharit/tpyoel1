<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormJeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
        ->add('number', NumberType::class,
        [
            'label'=>"chiffre gagnant",
            'required' => true,
            'constraints' => [
                new Range([
                    'min' => 0,
                    'max' => 100,
                    'notInRangeMessage' => 'il faut être entre {{ min }} et {{ max }}]',
                ])
            ]
        ])
        ->add('valider',SubmitType::class)
        
    ;
}

public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        // Configure your form options here
    ]);
}
}
