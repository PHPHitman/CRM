<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/crm", name="crm.")
 */
class CrmController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('crm/index.html.twig', [
            'controller_name' => 'CrmController',
        ]);
    }
}
