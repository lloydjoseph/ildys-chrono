<?php
namespace App\EventListener;

use App\Entity\LogAction;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LogoutListener extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function onSymfonyComponentSecurityHttpEventLogoutEvent()
    {
        // Log action
        $log = new LogAction();
        $log->setDDateTransaction(new DateTime());
        $log->setIIdUser($this->session->get('iIdUser'));
        $log->setVAction('D');

        // Instantiate Doctrine Manager
        $entityManager = $this->getDoctrine()->getManager();

        // Persist log
        $entityManager->persist($log);

        // Flush data (clear or reload various internal caches)
        $entityManager->flush();
    }
}