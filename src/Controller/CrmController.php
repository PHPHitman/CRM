<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Entity\User;
use App\Form\ClientType;
use App\Repository\ClientsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/crm", name="crm.")
 */
class CrmController extends AbstractController
{

    /**
     *@Route("/", name="index")
     */
    public function index()
    {
        return $this->render('crm/index.html.twig');

    }


    /**
     * @Route("/clients", name="clients")
     * @param ClientsRepository $clientsRepository
     * @return Response
     */
    public function clients(ClientsRepository $clientsRepository)
    {
        $clients = $clientsRepository->findAll();


        return $this->render('crm/clients.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $client = new Clients();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        $username = $this->getUser()->getUsername();
        $client->setAddedBy($username);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($client);
            $em->flush();
            $this->addFlash('success', 'Klient został dodany!');

            return $this->redirect($this->generateUrl('crm.clients'));
        }



        return $this->render('crm/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Clients $clients
     * @return Response
     */

    //Use ParamConverter
    public function show(Clients $clients)
    {

        //return view
        return $this->render('crm/show.html.twig', [
            'client' => $clients

        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Clients $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove(Clients $clients)
    {
        //entity manager
        $em = $this->getDoctrine()->getManager();

        $em -> remove($clients);
        $em->flush();

        //flash message
        $this->addFlash('removed', 'Klient został usunięty!');
        return $this->redirect($this->generateUrl('crm.clients'));
    }

    /**
     * @Route("/users", name="users")
     * @param UserRepository $userRepository
     * @return Response
     */

    public function users(UserRepository $userRepository)
    {
    $users = $userRepository->findAll();

    return $this->render('crm/users.html.twig',[
        'users' => $users
    ]);
    }

    /**
     * @Route("/users/{id}", name="showuser")
     * @param User $user
     * @return Response
     */

     public function showuser(User $user){
        return $this->render('users/show.html.twig',[
            'user' => $user
        ]);
     }

    /**
     * @Route("/users/delete/{id}", name="deleteUser")
     * @param Clients $post
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
        return $this->redirect($this->generateUrl('crm.users'));
    }



}
