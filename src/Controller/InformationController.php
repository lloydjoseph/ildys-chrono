<?php

namespace App\Controller;

use App\Entity\NoteInformation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InformationController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function information()
    {
        $notesInformation = $this->getDoctrine()
            ->getRepository(NoteInformation::class)
            ->getAllRows();

        if($this->session->get('loggedIn')) {
            return $this->render('information/layout.html.twig', [
                'notesInformation' => $notesInformation
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}