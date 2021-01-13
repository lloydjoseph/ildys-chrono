<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdministrationFilterType;
use App\Form\AdministrationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrationController extends AbstractController
{
    public function administration(Request $request): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->getAllRows();

        // Create the form from the user info
        $form2 = $this->createForm(AdministrationFilterType::class);

        // Handle the form submission
        $form2->handleRequest($request);

        // Check is form is submitted and valid
        if ($form2->isSubmitted()) {



            return $this->redirectToRoute('administration', [

            ]);
        }



        return $this->render('administration/layout.html.twig', [
            'users' => $users
        ]);
    }
}