<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function default()
    {
        return $this->redirectToRoute('connexion');
    }
}
