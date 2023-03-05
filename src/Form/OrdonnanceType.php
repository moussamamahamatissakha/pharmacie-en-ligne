<?php

namespace App\Form;

use App\Entity\Ordonnance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextareaType::class,[
                'label'=>'commentaire',
                'label_attr'=>[
                    'class' => 'form-label mt-2',
    
                ],
                'attr' => [
                    'placeholder' => 'veillez ecrire votre question',
                    'class' => 'form-control',
                    'type' => 'textarea',
                    
                ],
            ])
            ->add('image', FileType::class,[
                'label'=>' ',
                'label_attr'=>[
                    'class' => 'form-label  ',
    
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
            'data_class' => Ordonnance::class,
        ]);
    }
}
