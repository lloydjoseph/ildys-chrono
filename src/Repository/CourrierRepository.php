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

        if(isset($_GET['month']) && !empty($_GET['month'])) $sql .= ' AND MONTH(c.creation_date) LIKE \'%' . $_GET['month'] . '%\'';
        if(isset($_GET['number']) && !empty($_GET['number'])) $sql .= ' AND c.number LIKE \'%' . $_GET['number'] . '%\'';
        if(isset($_GET['subject']) && !empty($_GET['subject'])) $sql .= ' AND c.subject LIKE \'%' . $_GET['subject'] . '%\'';
        if(isset($_GET['recipient']) && !empty($_GET['recipient'])) $sql .= ' AND c.recipient LIKE \'%' . $_GET['recipient'] . '%\'';

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Courrier c
            WHERE 1 = 1
            ' . $sql . ' 
            ORDER BY c.creation_date ASC'
        );

        // returns an array of Courrier objects
        return $query->getResult();
    }

    // /**
    //  * @return Courrier[] Returns an array of Courrier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Courrier
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
