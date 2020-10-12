<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnexionController extends AbstractController
{
    public function connexion(): Response
    {
        return $this->render('connexion/layout.html.twig', []);
    }
}