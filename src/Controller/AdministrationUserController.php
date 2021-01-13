<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationUserController extends AbstractController
{
    public function user(): Response
    {
        return $this->redirectToRoute('administration user common', [], 301);
    }
}