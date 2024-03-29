<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Entity\LogAction;
use App\Form\CourrierCreateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CourrierCreateController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function create(Request $request): Response
    {
        $courrierCount = $this->getDoctrine()
            ->getRepository(Courrier::class)
            ->getCourrierCount();

        $courrier = new Courrier();

        $form = $this->createForm(CourrierCreateType::class, $courrier);

        $courrierNumber = $courrierCount[0][1] + 1;

        $form->get('iNumero')->setData($courrierNumber);

        $form->get('dDateCreation')->setData(new \DateTime());

        $form->get('iIdUser')->setData($this->session->get('iIdUser'));

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
            $log->setVAction('A');

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

        if($this->session->get('loggedIn') && $this->session->get('bAjoutCourrier')) {
            // Render the controller
            return $this->render('courrier/create/layout.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}