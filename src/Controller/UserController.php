<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/users", name="users.")
 */
class UserController extends AbstractController
{


    /**
     * @Route("/", name="index")
     * @param UserRepository $userRepository
     * @return Response
     */

    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('users/index.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/{id}", name="show")
     * @param User $user
     * @return Response
     */

    public function showuser(User $user){
        return $this->render('users/show.html.twig',[
            'user' => $user
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="delete")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        //entity manager
        $em = $this->getDoctrine()->getManager();

        $em -> remove($user);
        $em->flush();

        //flash message
        $this->addFlash('removed', 'Użytkownik został usunięty!');
        return $this->redirect($this->generateUrl('users.index'));
    }


}
