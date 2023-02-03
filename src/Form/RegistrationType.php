<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('lastname', TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'maxlength' => '255',
                    ],
                    'label' => 'Nom',
                    'label_attr' => [
                        'class' => 'form_label mt-4 fs-5 mb-3'
                    ],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['max' => 255])
                    ]
                ])
                ->add('firstname', TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'maxlength' => '255',
                    ],
                    'label' => 'Prénom',
                    'label_attr' => [
                        'class' => 'form_label mt-4 fs-5 mb-3'
                    ],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['max' => 255])
                    ]
                ])
                // ->add('address', TextType::class, [
                //     'attr' => [
                //         'class' => 'form-control',
                //         'maxlength' => '255',
                //     ],
                //     'label' => 'Adresse Postale',
                //     'label_attr' => [
                //         'class' => 'form_label mt-4 fs-5 mb-3'
                //     ],
                //     'constraints' => [
                //         new Assert\NotBlank(),
                //         new Assert\Length(['max' => 255])
                //     ]
                // ])
                // ->add('zip_code', TextType::class, [
                //     'attr' => [
                //         'class' => 'form-control',
                //         'minlength' => '5',
                //         'maxlength' => '50',
                //     ],
                //     'label' => 'Code Postal',
                //     'label_attr' => [
                //         'class' => 'form_label mt-4 fs-5 mb-3'
                //     ],
                //     'constraints' => [
                //         new Assert\NotBlank(),
                //         new Assert\Length(['min' => 5, 'max' => 50])
                //     ]
                // ])
                // ->add('city', TextType::class, [
                //     'attr' => [
                //         'class' => 'form-control',
                //         'minlength' => '4',
                //         'maxlength' => '50',
                //     ],
                //     'label' => 'Ville',
                //     'label_attr' => [
                //         'class' => 'form_label mt-4 fs-5 mb-3'
                //     ],
                //     'constraints' => [
                //         new Assert\NotBlank(),
                //         new Assert\Length(['min' => 4, 'max' => 50])
                //     ]
                // ])
                ->add('phone_number', TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => '10',
                        'maxlength' => '50',
                    ],
                    'label' => 'Numéro de téléphone',
                    'label_attr' => [
                        'class' => 'form_label mt-4 fs-5 mb-3'
                    ],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 10, 'max' => 50])
                    ]
                ])
                ->add('email', EmailType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'maxlength' => '180',
                    ],
                    'label' => 'Adresse Email',
                    'label_attr' => [
                        'class' => 'form_label mt-4 fs-5 mb-3'
                    ],
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Email(),
                        new Assert\Length(['max' => 180])
                    ]
                ])
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'first_options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'label' => 'Mot de passe',
                        'label_attr' => [
                            'class' => 'form_label mt-4 fs-5 mb-3'
                        ]
                    ],
                    'second_options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'label' => 'Confirmation du mot de passe',
                        'label_attr' => [
                            'class' => 'form_label mt-4 fs-5 mb-3'
                        ]
                    ],
                    'invalid_message' => 'Les mots de passe ne correspondent pas.'
                ])
                ->add('submit', SubmitType::class, [
                    'attr' => [
                        'class' => 'btn mt-4 fs-5 mb-3'
                    ]
                ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
