<?php

namespace App\Repository;

use App\Entity\NoteService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteService|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteService|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteService[]    findAll()
 * @method NoteService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteService::class);
    }

    public function getAllRows() {
        $entityManager = $this->getEntityManager();

        $sql = '';

        if(isset($_GET['month']) && !empty($_GET['month'])) $sql .= ' AND MONTH(c.creation_date) LIKE \'%' . $_GET['month'] . '%\'';
        if(isset($_GET['number']) && !empty($_GET['number'])) $sql .= ' AND c.number LIKE \'%' . $_GET['number'] . '%\'';
        if(isset($_GET['subject']) && !empty($_GET['subject'])) $sql .= ' AND c.subject LIKE \'%' . $_GET['subject'] . '%\'';
        if(isset($_GET['service']) && !empty($_GET['service'])) $sql .= ' AND c.service LIKE \'%' . $_GET['service'] . '%\'';

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\NoteService c
            WHERE 1 = 1
            ' . $sql . ' 
            ORDER BY c.creation_date ASC'
        );

        // returns an array of NoteService objects
        return $query->getResult();
    }

    // /**
    //  * @return NoteService[] Returns an array of NoteService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteService
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
