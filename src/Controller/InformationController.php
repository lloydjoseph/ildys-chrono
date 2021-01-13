<?php

namespace App\Controller;

use App\Entity\NoteInformation;
use App\Form\NoteInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformationController extends AbstractController
{
    public function information(Request $request): Response
    {
        $notesInformation = $this->getDoctrine()
            ->getRepository(NoteInformation::class)
            ->getAllRows();

        $noteInformation = new NoteInformation();

        // Create the form from the user info
        $form = $this->createForm(NoteInformationType::class, $noteInformation);

        $form->get('creationDate')->setData(new \DateTime());

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $noteInformation = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($noteInformation);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('information', [
                'result' => 200
            ]);
        }

        return $this->render('information/layout.html.twig', [
            'notesInformation' => $notesInformation,
            'form' => $form->createView()
        ]);
    }
}