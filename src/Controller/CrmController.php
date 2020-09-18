<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



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



}
