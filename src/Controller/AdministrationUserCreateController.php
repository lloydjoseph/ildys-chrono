<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationUserCreateController extends AbstractController
{
    public function create(): Response
    {
        return $this->render('administration/user/create/layout.html.twig', []);
    }
}