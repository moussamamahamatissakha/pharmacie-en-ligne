<?php

namespace App\Form;

use App\Entity\Livreur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'nom',
                'label_attr'=>[
                    'class' => 'form-label mt-2',
    
                ],
                'attr' => [
                    'placeholder' => 'nom',
                    'class' => 'form-control',
                    
                ],
            ])
            ->add('tel',TextType::class,[
                'label'=>'telephone',
                'label_attr'=>[
                    'class' => 'form-label mt-2',
    
                ],
                'attr' => [
                    'placeholder' => 'telephone',
                    'class' => 'form-control',
                    
                ],
            ])
            ->add('matricule',TextType::class,[
                'label'=>'matricule',
                'label_attr'=>[
                    'class' => 'form-label mt-2',
    
                ],
                'attr' => [
                    'placeholder' => 'matricule',
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
            'data_class' => Livreur::class,
        ]);
    }
}
