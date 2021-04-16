<?php

namespace App\Repository;

use App\Entity\Courrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Courrier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Courrier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Courrier[]    findAll()
 * @method Courrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Courrier::class);
    }

    public function getAllRows() {
        $entityManager = $this->getEntityManager();

        $sql = '';

        if(isset($_GET['day']) && !empty($_GET['day'])) $sql .= ' AND DAY(c.d_date_creation) LIKE \'%' . $_GET['day'] . '%\'';
        if(isset($_GET['month']) && !empty($_GET['month'])) $sql .= ' AND MONTH(c.d_date_creation) LIKE \'%' . $_GET['month'] . '%\'';
        if(isset($_GET['year']) && !empty($_GET['year'])) $sql .= ' AND YEAR(c.d_date_creation) LIKE \'%' . $_GET['year'] . '%\'';
        if(isset($_GET['number']) && !empty($_GET['number'])) $sql .= ' AND c.i_numero LIKE \'%' . $_GET['number'] . '%\'';
        if(isset($_GET['subject']) && !empty($_GET['subject'])) $sql .= ' AND c.v_libelle LIKE \'%' . $_GET['subject'] . '%\'';
        if(isset($_GET['recipient']) && !empty($_GET['recipient'])) $sql .= ' AND c.v_destinataire LIKE \'%' . $_GET['recipient'] . '%\'';

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Courrier c
            WHERE 1 = 1
            ' . $sql . ' 
            ORDER BY c.d_date_creation ASC'
        );

        // returns an array of Courrier objects
        return $query->getResult();
    }

    public function getCourrierCount() {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT COUNT(c.i_numero)
            FROM App\Entity\Courrier c
            WHERE YEAR(c.d_date_creation) = YEAR(CURRENT_TIMESTAMP())'
        );

        // returns an array of Courrier objects
        return $query->getResult();
    }

}
