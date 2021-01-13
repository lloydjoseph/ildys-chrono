<?php

namespace App\Repository;

use App\Entity\NoteInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteInformation[]    findAll()
 * @method NoteInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteInformation::class);
    }

    public function getAllRows() {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT n
            FROM App\Entity\NoteInformation n
            ORDER BY n.creation_date ASC'
        );

        // returns an array of NoteInformation objects
        return $query->getResult();
    }

    // /**
    //  * @return NoteInformation[] Returns an array of NoteInformation objects
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
    public function findOneBySomeField($value): ?NoteInformation
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
