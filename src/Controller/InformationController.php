<?php

namespace App\Controller;

use App\Entity\NoteInformation;
use App\Form\NoteInformationFilterType;
use App\Form\NoteInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InformationController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function information(Request $request): Response
    {
        $notesInformation = $this->getDoctrine()
            ->getRepository(NoteInformation::class)
            ->getAllRows();

        $noteInformation = new NoteInformation();

        // Create the form from the user info
        $form1 = $this->createForm(NoteInformationType::class, $noteInformation);

        // Create the form from the user info
        $form2 = $this->createForm(NoteInformationFilterType::class, $noteInformation);

        $form1->get('creationDate')->setData(new \DateTime());

        // Handle the form submission
        $form1->handleRequest($request);

        // Handle the form submission
        $form2->handleRequest($request);

        // Check is form is submitted and valid
        if ($form1->isSubmitted() && $form1->isValid()) {

            // Get the data from the form
            $noteInformation = $form1->getData();

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

            return $this->redirectToRoute('information', [

            ]);
        }


        if($this->session->get('loggedIn')) {
            return $this->render('information/layout.html.twig', [
                'notesInformation' => $notesInformation,
                'form' => $form1->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}