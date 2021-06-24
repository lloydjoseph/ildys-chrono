<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\AdministrationUserCreateType;
use App\Entity\Permission;
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

        $permissions = new Permission();

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

            // Set permissions and get persisted ID
            $permissions->setIIdUser($user->getIIdUser());
            $permissions->setBAjoutCourrier(0);
            $permissions->setBModifCourrier(0);
            $permissions->setBSupprCourrier(0);
            $permissions->setBAjoutNoteInfo(0);
            $permissions->setBModifNoteInfo(0);
            $permissions->setBSupprNoteInfo(0);
            $permissions->setBAjoutNoteServ(0);
            $permissions->setBModifNoteServ(0);
            $permissions->setBSupprNoteServ(0);

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($permissions);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('administration', [
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