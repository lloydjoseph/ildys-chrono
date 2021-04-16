<?php

namespace App\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="Utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="i_id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $i_id_user;

    /**
     * @var string|null
     *
     * @ORM\Column(name="v_identifiant", type="string", length=255, nullable=true)
     */
    private $v_identifiant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="v_prenom_user", type="string", length=255, nullable=true)
     */
    private $v_prenom_user;

    /**
     * @var string|null
     *
     * @ORM\Column(name="v_nom_user", type="string", length=255, nullable=true)
     */
    private $v_nom_user;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="b_admin", type="boolean", nullable=true)
     */
    private $bAdmin;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="b_actif", type="boolean", nullable=true)
     */
    private $bActif;


}
