<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',EmailType::class,[
                'label'=>'email',
                'label_attr'=>[
                    'class' => 'form-label mt-2',

                ],
                'attr' => [
                    'placeholder' => 'G-email',
                    'class' => 'form-control',
                    
                ],
            ])
            ->add('nomComplet',TextType::class,[
                'label'=>'Nom Complet',
                'label_attr'=>[
                    'class' => 'form-label mt-2',

                ],
                'attr' => [
                    'placeholder' => 'Nom et Prenom',
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
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label'=>'password',
                'label_attr'=>[
                    'class' => 'form-label mt-2',

                ],
                
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'placeholder' => 'mot de passe',
                'class' => 'form-control',
            ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
