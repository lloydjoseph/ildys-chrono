<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationController extends AbstractController
{
    public function administration(): Response
    {
        return $this->render('administration/layout.html.twig', []);
    }
}