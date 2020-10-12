<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourrierController extends AbstractController
{
    public function courrier(): Response
    {
        return $this->render('courrier/layout.html.twig', []);
    }
}