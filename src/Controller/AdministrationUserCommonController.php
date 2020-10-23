<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationUserCommonController extends AbstractController
{
    public function common(): Response
    {
        return $this->render('administration/user/common/layout.html.twig', []);
    }
}