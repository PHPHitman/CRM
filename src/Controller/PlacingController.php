<?php

namespace App\Controller;

use App\Entity\Placings;
use App\Form\PlacingType;
use App\Repository\PlacingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @Route("/placing", name="placing.")
 */
class PlacingController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PlacingsRepository $placingsRepository
     * @param UserInterface $user
     * @param \ExampleService $exampleService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PlacingsRepository $placingsRepository, UserInterface $user)
    {

        $placings = $placingsRepository->findAll();




        return $this->render('placing/index.html.twig',[
            'placings' => $placings,

        ]);
    }


    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {

        $placing = new Placings();
        $form = $this->createForm(PlacingType::class, $placing);

        $form->handleRequest($request);
        $username = $this->getUser()->getUsername();
        $placing->setAddedBy($username);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();


            $em->persist($placing);
            $em->flush();

            return $this->redirect($this->generateUrl('placing.index'));
        }

        return $this->render('placing/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Placings $placing
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function show(Placings $placing)
    {
        return $this->render('placing/show.html.twig', [
            'placing' => $placing
        ]);
    }
}
