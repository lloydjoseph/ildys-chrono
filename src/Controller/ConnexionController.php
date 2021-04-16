<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Utilisateur;
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
        // Variable initialization
        $error = '';
        $results = "";
        $userInActiveDirectory = false;
        $userNotInDatabase = true;
        $userIsActive = false;
        $info = [];
        $firstname = "";
        $lastname = "";

        // Create the connection form with username, password and submit button
        $form = $this->createFormBuilder()
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

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Get username and password from submitted data
            $username = $form->get('user')->getData();
            $password = $form->get('password')->getData();

            // Try to connect to Active Directory using submitted data
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
                    $userInActiveDirectory = true;
                    $firstname = $info[$i]["givenname"][0];
                    $lastname = $info[$i]["sn"][0];
                }
                @ldap_close($ldap);
            }

            // If no user is found, throw Exeption
            if($userInActiveDirectory == false) {
                throw $this->createNotFoundException("Échec de l'authentification au serveur Active Directory");
            }

            // Check if user exists in database
            $retrievedUserFromDatabase = $this->getDoctrine()
                ->getRepository(Utilisateur::class)
                ->findOneBy(['v_identifiant' => $username]);

            // Set variable to true or false, depending if data exists
            $userNotInDatabase = empty($retrievedUserFromDatabase);

            // If no user exists in the database, throw Exeption
            if($userNotInDatabase) {
                throw $this->createNotFoundException("L'utilisateur n'existe pas dans la base de données");
            }

            // Set variable to true or false, depending if user's account is active
            $userIsActive = $retrievedUserFromDatabase->getBActif();

            // If the user's account is disabled, throw Exeption
            if(!$userIsActive) {
                throw $this->createNotFoundException("Ce compte a été désactivé");
            }

            $userId = $retrievedUserFromDatabase->getIIdUser();

            // Get permissions from user id
            $permission = $this->getDoctrine()
                ->getRepository(Permission::class)
                ->findOneBy(['i_id_user' => $userId]);

            $this->session->set('results', $results);
            $this->session->set('info', $info);

            $this->session->set('information', [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "username" => $username
            ]);

            $this->session->set('bAjoutCourrier', $permission->getBAjoutCourrier());
            $this->session->set('bModifCourrier', $permission->getBModifCourrier());
            $this->session->set('bSupprCourrier', $permission->getBSupprCourrier());
            $this->session->set('bAjoutNoteInfo', $permission->getBAjoutNoteInfo());
            $this->session->set('bModifNoteInfo', $permission->getBModifNoteInfo());
            $this->session->set('bSupprNoteInfo', $permission->getBSupprNoteInfo());
            $this->session->set('bAjoutNoteServ', $permission->getBAjoutNoteServ());
            $this->session->set('bModifNoteServ', $permission->getBModifNoteServ());
            $this->session->set('bSupprNoteServ', $permission->getBSupprNoteServ());

            $this->session->set('iIdUser', $userId);

            $this->session->set('user', $retrievedUserFromDatabase);
            $this->session->set('loggedIn', true);
            $this->session->set('isAdmin', $retrievedUserFromDatabase->getBAdmin());

            return $this->redirectToRoute('courrier', []);
        }

        return $this->render('connexion/layout.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}