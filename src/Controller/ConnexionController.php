<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnexionType;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ConnexionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function connexion(Request $request): Response
    {
        $user = new User();

        // Create the form from the user info
        $form = $this->createForm(ConnexionType::class, $user);

        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $connexion = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            $code = $form->get('code')->getData();
//            $this->session->set('code2', $code2);

//            $code = 7946;

            $password = $this->getDoctrine()
                ->getRepository(User::class)
                ->getUserPasswordByCode($code);

            $this->session->set('code', $password);

            if(true) {
                return $this->redirectToRoute('courrier', []);
            }

        }

        return $this->render('connexion/layout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}