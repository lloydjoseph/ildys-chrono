<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Entity\LogAction;
use App\Form\CourrierModifyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CourrierModifyController extends AbstractController
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

        $courrier = $this->getDoctrine()
            ->getRepository(Courrier::class)
            ->find($id);

        $form = $this->createForm(CourrierModifyType::class, $courrier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $courrier = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($courrier);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            // Log action
            $log = new LogAction();
            $log->setDDateTransaction(new \DateTime());
            $log->setIIdUser($this->session->get('iIdUser'));
            $log->setIIdRef($courrier->getIIdCourrier());
            $log->setITypeRef(1);
            $log->setVAction('M');

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist log
            $entityManager->persist($log);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('courrier', [
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('bModifCourrier')) {
            // Render the controller
            return $this->render('courrier/modify/layout.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}