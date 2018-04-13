<?php

namespace App\Form;

use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nom', TextType::class, array(
                    'label' => 'Votre Nom',
                    'attr' => array(
                        'type' => 'text',
                        'data-length' => '30'
                    )
            ))
            ->add('participe', ChoiceType::class, array(
                'label' => 'Serez-vous des nôtres ?',
                'choices'  => array(
                    'Oui' => true,
                    'Non' => false,
                )
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Qui vous accompagnera ?',
                'attr' => array(
                    'type' => 'text',
                    'data-length' => '500'
                )
            ))
            ->add(
                'email', EmailType::class, array(
                'label' => 'Email de contact',
                'attr' => array(
                    'type' => 'text',
                    'data-length' => '55'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
