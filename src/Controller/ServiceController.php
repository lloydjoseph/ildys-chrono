<?php

namespace App\Controller;

use App\Entity\NoteService;
use App\Form\NoteServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    public function service(Request $request): Response
    {
        $notesService = $this->getDoctrine()
            ->getRepository(NoteService::class)
            ->getAllRows();

        $noteService = new NoteService();

        // Create the form from the user info
        $form = $this->createForm(NoteServiceType::class, $noteService);

        $form->get('creationDate')->setData(new \DateTime());

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $noteService = $form->getData();

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

        return $this->render('service/layout.html.twig', [
            'notesService' => $notesService,
            'form' => $form->createView()
        ]);
    }
}