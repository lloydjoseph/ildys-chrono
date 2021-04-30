<?php

namespace App\Controller;

use App\Entity\LogAction;
use App\Entity\NoteService;
use App\Form\NoteServiceCreateType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServiceCreateController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function create(Request $request): Response
    {
        $noteServiceCount = $this->getDoctrine()
            ->getRepository(NoteService::class)
            ->getNoteServiceCount();

        $noteService = new NoteService();

        $form = $this->createForm(NoteServiceCreateType::class, $noteService);

        $noteServiceNumber = $noteServiceCount[0][1] + 1;

        $form->get('iNumero')->setData($noteServiceNumber);

        $form->get('dDateCreation')->setData(new DateTime());

        $form->get('iIdUser')->setData($this->session->get('iIdUser'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $noteService = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($noteService);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            // Log action
            $log = new LogAction();
            $log->setDDateTransaction(new DateTime());
            $log->setIIdUser($this->session->get('iIdUser'));
            $log->setIIdRef($noteService->getIIdNote());
            $log->setITypeRef(3);
            $log->setVAction('A');

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist log
            $entityManager->persist($log);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('service', [
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('bAjoutNoteServ')) {
            // Render the controller
            return $this->render('service/create/layout.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}