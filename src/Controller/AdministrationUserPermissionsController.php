<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Utilisateur;
use App\Form\AdministrationUserPermissionsAdminType;
use App\Form\AdministrationUserPermissionsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdministrationUserPermissionsController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function permissions(Request $request)
    {
        // Get the user ID
        $id = $_GET['id'];

        // Throw error if no ID
        if (!$id) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        // Get user info from user ID
        $permission = $this->getDoctrine()
            ->getRepository(Permission::class)
            ->findOneBy(['i_id_user' => $id]);

        // Get user info from user ID
        $permissionAdmin = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findOneBy(['i_id_user' => $id]);

        // Create the form from the user info
        $form = $this->createForm(AdministrationUserPermissionsType::class, $permission);

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $user = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($user);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('administration user permissions', [
                'id' => $id,
                'result' => 200
            ]);
        }

        // Create the form from the user info
        $formAdmin = $this->createForm(AdministrationUserPermissionsAdminType::class, $permissionAdmin);

        // Handle the form submission
        $formAdmin->handleRequest($request);

        // Check is form is submitted and valid
        if ($formAdmin->isSubmitted() && $formAdmin->isValid()) {

            // Get the data from the form
            $user = $formAdmin->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($user);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('administration user permissions', [
                'id' => $id,
                'result' => 200
            ]);
        }

        if($this->session->get('loggedIn') && $this->session->get('isAdmin')) {
            // Render the controller
            return $this->render('administration/user/permissions/layout.html.twig', [
                'form' => $form->createView(),
                'formAdmin' => $formAdmin->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}