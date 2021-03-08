<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnexionType;
use Symfony\Component\Ldap\Ldap;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $error = '';

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
////            $this->session->set('code2', $code2);
//
////            $code = 7946;
//
//            $password = $this->getDoctrine()
//                ->getRepository(User::class)
//                ->getUserPasswordByCode($code);
//
//            $this->session->set('code', $password);

            



            $isValidUser = false;

            // We check if user exists in database
            $retrievedUser = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['code' => $code]);

            // If exists, send form data to LDAP
            $correctLDAP = false;
            $dn = 'ldapuser';
            $password = 'selsabile';

            $ldap = Ldap::create('ext_ldap', [
                'host' => '172.16.0.3'
            ]);

            $ldap->bind($dn, $password);

            $query = $ldap->query('dc=ildys,dc=int', '(&(objectclass=person) (sAMAccountname=' . $code . '))');
            $results = $query->execute()->toArray();
            $this->session->set('results', $results);

            if(!empty($results)) {
                // Log in the user and start session

                if($retrievedUser != "") {

                    $this->session->set('user', $retrievedUser);
                    $this->session->set('isAdmin', $retrievedUser->getIsAdmin());

//                $retrievedUserPermissions = $this->getDoctrine()
//                    ->getRepository(User::class)
//                    ->findOneBy(['id_user' => $retrievedUser->getId()]);

                    return $this->redirectToRoute('courrier', []);
                }
                $error = '⚠️ L\'utilisteur ' . $code .  ' n\'existe pas dans la base';
            }

            $error = '⚠️ Identifiant incorrect';

        }

        return $this->render('connexion/layout.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}