<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Form\CourrierFilterType;
use App\Form\CourrierType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CourrierController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function courrier(Request $request): Response
    {
        $courriers = $this->getDoctrine()
            ->getRepository(Courrier::class)
            ->getAllRows();

        $courrier = new Courrier();

        // Create the form from the user info
        $form = $this->createForm(CourrierFilterType::class, $courrier);

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted()) {

            // Get the data from the form
            $filter = $form->getData();

            return $this->redirectToRoute('courrier', [

            ]);
        }

        if($this->session->get('loggedIn')) {
            return $this->render('courrier/layout.html.twig', [
                'courriers' => $courriers,
                'filters' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('connexion');
        }
    }
}