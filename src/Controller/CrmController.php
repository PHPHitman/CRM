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
 * @Route("/crm", name="crm.")
 */
class CrmController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param ClientsRepository $clientsRepository
     * @return Response
     */
    public function index(ClientsRepository $clientsRepository)
    {
        $clients = $clientsRepository->findAll();


        return $this->render('crm/index.html.twig', [
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

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($client);
            $em->flush();
            $this->addFlash('success', 'Klient został dodany!');

            return $this->redirect($this->generateUrl('crm.index'));
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
    public function remove(Clients $post)
    {
        //entity manager
        $em = $this->getDoctrine()->getManager();

        $em -> remove($post);
        $em->flush();

        //flash message
        $this->addFlash('removed', 'Klient został usunięty!');
        return $this->redirect($this->generateUrl('crm.index'));
    }



}
