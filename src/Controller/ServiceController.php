<?php

namespace App\Controller;

use App\Entity\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServiceController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function service()
    {
        $notesService = $this->getDoctrine()
            ->getRepository(NoteService::class)
            ->getAllRows();

        if($this->session->get('loggedIn')) {
            return $this->render('service/layout.html.twig', [
                'notesService' => $notesService
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}