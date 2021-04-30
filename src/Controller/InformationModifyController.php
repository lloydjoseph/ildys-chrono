<?php

namespace App\Controller;

use App\Entity\LogAction;
use App\Entity\NoteInformation;
use App\Form\NoteInformationModifyType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class InformationModifyController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function modify(Request $request): Response
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

        $form = $this->createForm(NoteInformationModifyType::class, $noteInformation);

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
            $log->setVAction('M');

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

        if($this->session->get('loggedIn') && $this->session->get('bModifNoteInfo')) {
            // Render the controller
            return $this->render('information/modify/layout.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}