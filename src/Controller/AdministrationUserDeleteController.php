<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdministrationUserDeleteController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function delete(): Response
    {

        if($this->session->get('loggedIn') && $this->session->get('isAdmin')) {
            // Render the controller
            return $this->render('administration/user/delete/layout.html.twig', []);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}