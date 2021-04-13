<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnexionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        // Create the form from the user info
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('user', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-2'
                ]
            ])
            ->add('login', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-blue'
                ]
            ])
            ->getForm();
        // Handle the form submission
        $form->handleRequest($request);

        // Check is form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get the data from the form
            $connexion = $form->getData();

            // Instantiate Doctrine Manager
            $entityManager = $this->getDoctrine()->getManager();

//            $username = $form->get('user')->getData();
//            $password = $form->get('password')->getData();
            $username = "JLL7946";
            $password = "yKg4SVVM";

            $results = "";
            $userFound = false;
            $info = [];
            $firstname = "";
            $lastname = "";

            $isValidUser = false;

            // We check if user exists in database
            $retrievedUser = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['code' => $username]);

            $adServer = "ldap://thevenec.ildys.int";

            $ldap = ldap_connect($adServer);

            $ldaprdn = 'ildys' . "\\" . $username;

            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $bind = @ldap_bind($ldap, $ldaprdn, $password);

            if ($bind) {
                $filter="(sAMAccountName=$username)";
                $result = ldap_search($ldap,"dc=ildys,dc=int",$filter);
                ldap_sort($ldap,$result,"sn");
                $info = ldap_get_entries($ldap, $result);
                for ($i=0; $i<$info["count"]; $i++)
                {
                    if($info['count'] > 1)
                        break;
                    $userFound = true;
                    $firstname = $info[$i]["givenname"][0];
                    $lastname = $info[$i]["sn"][0];
                    echo 'test3';
                }
                @ldap_close($ldap);

            }

            $this->session->set('results', $results);
            $this->session->set('info', $info);

            $this->session->set('information', [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "username" => $username
            ]);

            if($userFound) {
                // Log in the user and start session

                if($retrievedUser != "") {

                    $this->session->set('user', $retrievedUser);
                    $this->session->set('loggedIn', true);
                    $this->session->set('isAdmin', $retrievedUser->getIsAdmin());



//                $retrievedUserPermissions = $this->getDoctrine()
//                    ->getRepository(User::class)
//                    ->findOneBy(['id_user' => $retrievedUser->getId()]);

                    return $this->redirectToRoute('courrier', []);
                }
                $error = '⚠️ L\'utilisteur ' . $username .  ' n\'existe pas dans la base';
            }

            $error = '⚠️ Identifiant ou mot de passe incorrect';

        }

        return $this->render('connexion/layout.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}