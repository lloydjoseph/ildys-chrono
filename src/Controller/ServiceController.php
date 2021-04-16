<?php

namespace App\Controller;

use App\Entity\NoteService;
use App\Form\NoteServiceFilterType;
use App\Form\NoteServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServiceController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function service(Request $request): Response
    {
        $notesService = $this->getDoctrine()
            ->getRepository(NoteService::class)
            ->getAllRows();

        $noteService = new NoteService();

        // Create the form from the user info
        $form1 = $this->createForm(NoteServiceType::class, $noteService);

        // Create the form from the user info
        $form2 = $this->createForm(NoteServiceFilterType::class, $noteService);

        $form1->get('dDateCreation')->setData(new \DateTime());

        // Handle the form submission
        $form1->handleRequest($request);

        // Handle the form submission
        $form2->handleRequest($request);

        // Check is form is submitted and valid
        if ($form1->isSubmitted() && $form1->isValid()) {

            // Get the data from the form
            $noteService = $form1->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($noteService);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('service', [
                'result' => 200
            ]);
        }

        // Check is form is submitted and valid
        if ($form2->isSubmitted()) {

            // Get the data from the form
            $filter = $form2->getData();
//
//            $val = $form2->get('number')->getData();
//
//            $courriers = $this->getDoctrine()
//                ->getRepository(Courrier::class)
//                ->getAllRows($val);

            return $this->redirectToRoute('service', [

            ]);
        }


        if($this->session->get('loggedIn')) {
            return $this->render('service/layout.html.twig', [
                'notesService' => $notesService,
                'form' => $form1->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}