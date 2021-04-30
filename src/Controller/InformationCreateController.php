<?php

namespace App\Controller;

use App\Entity\LogAction;
use App\Entity\NoteInformation;
use App\Form\NoteInformationCreateType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InformationCreateController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function create(Request $request): Response
    {
        $noteInformationCount = $this->getDoctrine()
            ->getRepository(NoteInformation::class)
            ->getNoteInformationCount();

        $noteInformation = new NoteInformation();

        $form = $this->createForm(NoteInformationCreateType::class, $noteInformation);

        $noteInformationNumber = $noteInformationCount[0][1] + 1;

        $form->get('iNumero')->setData($noteInformationNumber);

        $form->get('dDateCreation')->setData(new DateTime());

        $form->get('iIdUser')->setData($this->session->get('iIdUser'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $noteInformation = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($noteInformation);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            // Log action
            $log = new LogAction();
            $log->setDDateTransaction(new DateTime());
            $log->setIIdUser($this->session->get('iIdUser'));
            $log->setIIdRef($noteInformation->getIIdNote());
            $log->setITypeRef(2);
            $log->setVAction('A');

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist log
            $entityManager->persist($log);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('information', [
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('bAjoutNoteInfo')) {
            // Render the controller
            return $this->render('information/create/layout.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}