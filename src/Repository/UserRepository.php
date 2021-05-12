<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    // Returns all rows from Utilisateur table
    public function getAllRows() {

        $entityManager = $this->getEntityManager();

        $sql = '';

        if(isset($_GET['user']) && !empty($_GET['user'])) $sql .= ' AND u.v_prenom_user LIKE \'%' . $_GET['user'] . '%\' OR u.v_nom_user LIKE \'%' . $_GET['user'] . '%\'';

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Entity\Utilisateur u
            WHERE 1 = 1
            ' . $sql . ' 
            ORDER BY u.i_id_user ASC'
        );

        return $query->getResult();
    }
}
