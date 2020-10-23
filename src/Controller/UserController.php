<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function user(): RedirectResponse
    {
        return $this->redirectToRoute('administration user common', [], 301);
    }
}