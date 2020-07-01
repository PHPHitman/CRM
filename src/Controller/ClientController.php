<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientType;
use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/clients", name="clients.")
 */
class ClientController extends AbstractController

{
    /**
     * @Route("/", name="index")
     * @param ClientsRepository $clientsRepository
     * @return Response
     */
    public function clients(ClientsRepository $clientsRepository)
    {
        $clients = $clientsRepository->findAll();


        return $this->render('clients/index.html.twig', [
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

            return $this->redirect($this->generateUrl('clients.index'));
        }



        return $this->render('clients/create.html.twig', [
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
        return $this->render('clients/show.html.twig', [
            'client' => $clients

        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Clients $clients
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
        return $this->redirect($this->generateUrl('clients.index'));
    }
}
