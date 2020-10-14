<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;



class ConnexionController extends AbstractController
{
    public function connexion(): Response
    {
        $package = new Package(new EmptyVersionStrategy());

        $image = $package->getUrl('images/image.jpg');

        return $this->render('connexion/layout.html.twig', []);
    }
}