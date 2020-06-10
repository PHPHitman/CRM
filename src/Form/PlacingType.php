<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Placings;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('company', EntityType::class,[
                'class' => Clients::class,
                'label'=> 'Klient',
                'choice_label' => function ($client) {
                    return $client->getName() . ' ' . $client->getSurname() . ' ' . $client->getAddress();
                }])
            ->add('service', TextType::class,[
                'label' => 'Zlecenie'
            ])
            ->add('note', TextType::class,[
                'label'=>'Dodatkowe informacje'
            ])
            ->add('save', SubmitType::class,[
                'label'=>'Dodaj',
                'attr'=>[
                    'class' => 'btm btn-primary float-right'
                ]
            ])




        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Placings::class,
        ]);
    }
}
