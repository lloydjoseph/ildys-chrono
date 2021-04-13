<?php

namespace App\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table(name="permission")
 * @ORM\Entity
 */
class Permission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="courrier_add", type="boolean", nullable=true)
     */
    private $courrierAdd = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="courrier_mod", type="boolean", nullable=true)
     */
    private $courrierMod = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="courrier_del", type="boolean", nullable=true)
     */
    private $courrierDel = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="information_add", type="boolean", nullable=true)
     */
    private $informationAdd = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="information_mod", type="boolean", nullable=true)
     */
    private $informationMod = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="information_del", type="boolean", nullable=true)
     */
    private $informationDel = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="service_add", type="boolean", nullable=true)
     */
    private $serviceAdd = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="service_mod", type="boolean", nullable=true)
     */
    private $serviceMod = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="service_del", type="boolean", nullable=true)
     */
    private $serviceDel = '0';


}
