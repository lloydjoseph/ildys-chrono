<?php

namespace App\Controller;

use App\Entity\Utilisateur;
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
        $user = new Utilisateur();

        $form = $this->createForm(AdministrationUserCreateType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setBActif(1);

            // Get the data from the form
            $user = $form->getData();

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
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}