<?php

namespace App\Form;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Flex\Flex;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle',TextType::class,[
            'label'=>'libelle',
            'label_attr'=>[
                'class' => 'form-label mt-2',

            ],
            'attr' => [
                'placeholder' => 'libelle',
                'class' => 'form-control',
                
            ],
        ])
        ->add('date_debut',DateType::class,[
            'label'=>'date_debut',
            'label_attr'=>[
                'class' => 'form-label mt-2',

            ],
            'attr' => [
                'placeholder' => 'date_debut',
                'class' => 'form-control',
                
            ],
        ])
        ->add('date_exp',DateType::class,[
            'label'=>'date_exp',
            'label_attr'=>[
                'class' => 'form-label mt-2',

            ],
            'attr' => [
                'placeholder' => 'date_exp',
                'class' => 'form-control',
                
            ],
        ])
        ->add('prix',NumberType::class,[
            'label'=>'prix',
            'label_attr'=>[
                'class' => 'form-label mt-2',

            ],
            'attr' => [
                'placeholder' => 'prix',
                'class' => 'form-control',
                
            ],
        ])
        ->add('image', FileType::class,[
            'label'=>'image',
            'label_attr'=>[
                'class' => 'form-label mt-4 mb-4 ',

            ],
            'attr' => [
                'class' => 'pb-2',
                
            ]
            
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
