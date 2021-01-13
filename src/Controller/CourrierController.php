<?php

namespace App\Controller;

use App\Entity\Courrier;
use App\Form\CourrierFilterType;
use App\Form\CourrierType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourrierController extends AbstractController
{
    public function courrier(Request $request): Response
    {
        $courriers = $this->getDoctrine()
            ->getRepository(Courrier::class)
            ->getAllRows();

        $courrier = new Courrier();

        // Create the form from the user info
        $form1 = $this->createForm(CourrierType::class, $courrier);

        // Create the form from the user info
        $form2 = $this->createForm(CourrierFilterType::class, $courrier);

        $form1->get('creationDate')->setData(new \DateTime());

        // Handle the form submission
        $form1->handleRequest($request);

        // Handle the form submission
        $form2->handleRequest($request);

        // Check is form is submitted and valid
        if ($form1->isSubmitted() && $form1->isValid()) {

            // Get the data from the form
            $courrier = $form1->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

            // Persist retrieved data
            $entityManager->persist($courrier);

            // Flush data (clear or reload various internal caches)
            $entityManager->flush();

            return $this->redirectToRoute('courrier', [
                'result' => 200
            ]);
        }

        // Check is form is submitted and valid
        if ($form2->isSubmitted()) {

            // Get the data from the form
            $filter = $form2->getData();
//
//            $val = $form2->get('number')->getData();
//
//            $courriers = $this->getDoctrine()
//                ->getRepository(Courrier::class)
//                ->getAllRows($val);

            return $this->redirectToRoute('courrier', [

            ]);
        }

        return $this->render('courrier/layout.html.twig', [
            'courriers' => $courriers,
            'filters' => $form2->createView(),
            'form1' => $form1->createView()
        ]);
    }
}