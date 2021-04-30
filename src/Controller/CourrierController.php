<?php

namespace App\Controller;

use App\Entity\Courrier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CourrierController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function courrier()
    {
        $courriers = $this->getDoctrine()
            ->getRepository(Courrier::class)
            ->getAllRows();

        if($this->session->get('loggedIn')) {
            return $this->render('courrier/layout.html.twig', [
                'courriers' => $courriers
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}