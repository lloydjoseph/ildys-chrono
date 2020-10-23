<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationUserDeleteController extends AbstractController
{
    public function delete(): Response
    {
        return $this->render('administration/user/delete/layout.html.twig', []);
    }
}