<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\AdministrationUserDeleteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdministrationUserDeleteController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function delete(Request $request)
    {
        // Throw error if no ID given
        if (!isset($_GET['id']) || $_GET['id'] == '') {
            throw $this->createNotFoundException(
                'No id given'
            );
        }

        // Get the user ID
        $id = $_GET['id'];

        // Get user info from user ID
        $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find($id);

        // Create the form from the user info
        $form = $this->createForm(AdministrationUserDeleteType::class, $user);

        $userFirstLastName = $user->getVPrenomUser() . ' ' . $user->getVNomUser();

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Set b_actif to 0
            $user->setBActif(0);

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($user);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('administration user delete', [
                'id' => $id,
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('isAdmin')) {
            // Render the controller
            return $this->render('administration/user/delete/layout.html.twig', [
                'form' => $form->createView(),
                'userFirstLastName' => $userFirstLastName
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}