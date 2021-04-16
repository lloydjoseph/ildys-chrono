<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\AdministrationFilterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdministrationController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function administration(Request $request): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->getAllRows();

        // Create the form from the user info
        $form2 = $this->createForm(AdministrationFilterType::class);

        // Handle the form submission
        $form2->handleRequest($request);

        // Check is form is submitted and valid
        if ($form2->isSubmitted()) {

            return $this->redirectToRoute('administration', [

            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('isAdmin')) {
            return $this->render('administration/layout.html.twig', [
                'users' => $users
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}
