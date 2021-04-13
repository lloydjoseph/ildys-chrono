<?php

namespace App\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity
 */
class Log
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
     * @var int|null
     *
     * @ORM\Column(name="user", type="integer", nullable=true)
     */
    private $user;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="modification_date", type="datetime", nullable=true)
     */
    private $modificationDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="entry_nb", type="integer", nullable=true)
     */
    private $entryNb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entry_type", type="string", length=255, nullable=true)
     */
    private $entryType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="modification_type", type="string", length=255, nullable=true)
     */
    private $modificationType;


}
