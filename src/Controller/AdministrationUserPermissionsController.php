<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationUserPermissionsController extends AbstractController
{
    public function permissions(): Response
    {
        return $this->render('administration/user/permissions/layout.html.twig', []);
    }
}