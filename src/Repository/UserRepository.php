<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByFirstnameOrLastname($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Entity\User u
            WHERE u.firstname > :user
            ORDER BY u.firstname ASC'
        )->setParameter('user', $value);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getUserPasswordByCode($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.password
            FROM App\Entity\User u
            WHERE u.code = :code'
        )->setParameter('code', $value);

        return $query->getResult();
    }

    public function getIfUserExists($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.password
            FROM App\Entity\User u
            WHERE u.code = :code'
        )->setParameter('code', $value);

        return $query->getResult();
    }

    public function getAllRows() {

        $entityManager = $this->getEntityManager();

        $sql = '';

        if(isset($_GET['user']) && !empty($_GET['user'])) $sql .= ' AND c.firstname LIKE \'%' . $_GET['user'] . '%\' OR c.lastname LIKE \'%' . $_GET['user'] . '%\'';

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\User c
            WHERE 1 = 1
            ' . $sql . ' 
            ORDER BY c.lastname ASC'
        );

        // returns an array of Courrier objects
        return $query->getResult();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
