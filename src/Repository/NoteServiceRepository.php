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

        $query = $entityManager->createQuery(
            'SELECT n
            FROM App\Entity\NoteService n
            ORDER BY n.creation_date ASC'
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
