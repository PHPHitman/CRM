<?php

namespace App\Form;

use App\Entity\Clients;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class,[
                'label'=>'Imie'
            ])
            ->add('surname', TextType::class,[
                'label' => 'Nazwisko'
            ])
            ->add('city', TextType::class,[
                'label' => 'Miasto'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres'
            ])
            ->add('phone', TextType::class, [
                'label'=>'Numer telefonu'
            ])
            ->add('note', TextType::class,[
                'label'=>'Dodatkowe informacje'
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Dodaj',
                'attr' => [
                    'class' => 'btm btn-primary float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
