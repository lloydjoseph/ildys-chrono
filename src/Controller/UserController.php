<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setFirstname('Joseph');
        $user->setLastname('Lloyd');

        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('Saved ! Info :' . $user->getId());
    }
}
