<?php

namespace App\Controller;

use App\Entity\LogAction;
use App\Entity\NoteInformation;
use App\Form\NoteInformationDeleteType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InformationDeleteController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function delete(Request $request): Response
    {
        // Throw error if no ID given
        if (!isset($_GET['id']) || $_GET['id'] == '') {
            throw $this->createNotFoundException(
                'No id given'
            );
        }

        // Get the user ID
        $id = $_GET['id'];

        $noteInformation = $this->getDoctrine()
            ->getRepository(NoteInformation::class)
            ->find($id);

        $form = $this->createForm(NoteInformationDeleteType::class, $noteInformation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Remove retrieved data
            $entityManager->remove($noteInformation);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            // Log action
            $log = new LogAction();
            $log->setDDateTransaction(new DateTime());
            $log->setIIdUser($this->session->get('iIdUser'));
            $log->setIIdRef($noteInformation->getIIdCourrier());
            $log->setITypeRef(2);
            $log->setVAction('S');

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

        if($this->session->get('loggedIn') && $this->session->get('bSupprNoteInfo')) {
            // Render the controller
            return $this->render('information/delete/layout.html.twig', [
                'form' => $form->createView(),
                'noteInformation' => $noteInformation
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}