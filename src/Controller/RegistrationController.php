<?php

namespace App\Controller;

use App\Entity\User;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $form = $this->createFormBuilder()


            ->add('name',TextType::class, [
                'label'=>'Imie'
            ])

            ->add('surname', TextType::class, [
                'label' =>'Nazwisko'
            ])
            ->add('city', TextType::class,[
                'label'=>'Miasto'
            ])
            ->add('address', TextType::class,[
                'label'=>'Adres zamieszkania'
            ])


            ->add('username', TextType::class, [
                'label'=>'Nazwa użytkownika'
            ]
            )
            ->add('phone', TextType::class,[
                'label'=>'Nr. telefonu'
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Hasło'],
                'second_options' => ['label' => 'Potwierdź hasło'],
            ])
            ->add('Zarejestruj', SubmitType::class, [
                'attr' =>[
                    'class'=>'btn btn-info float-right'
                ]
            ])
            ->getForm();
        $form->handleRequest($request);


        if($form->isSubmitted())
        {
            $data=$form->getData();
            $user=new User();
            $user->setUsername($data['username']);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])

            );
            $user->setName($data['name']);
            $user->setSurname($data['surname']);
            $user->setAddress($data['address']);
            $user->setPhone($data['phone']);
            $user->setCity($data['city']);
          //  $user->setRoles($data['role']);


            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Pracownik został dodany');
            return $this->redirect($this->generateUrl('crm.users'));
        }

        return $this->render('registration/index.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
