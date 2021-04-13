<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdministrationUserCreateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdministrationUserCreateController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function create(Request $request): Response
    {
        $user = new User();

        $form1 = $this->createForm(AdministrationUserCreateType::class, $user);

        $form1->get('modificationDate')->setData(new \DateTime());

        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {

            // Get the data from the form
            $user = $form1->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($user);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('administration user create', [
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('isAdmin')) {
            // Render the controller
            return $this->render('administration/user/create/layout.html.twig', [
                'form' => $form1->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}