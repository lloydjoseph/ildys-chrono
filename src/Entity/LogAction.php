<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class LogAction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $i_id_log;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $i_id_user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $d_date_transaction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $v_action;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $i_type_ref;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $i_id_ref;

    public function getIIdLog(): ?int
    {
        return $this->i_id_log;
    }

    public function getIIdUser(): ?int
    {
        return $this->i_id_user;
    }

    public function setIIdUser(?int $i_id_user): self
    {
        $this->i_id_user = $i_id_user;

        return $this;
    }

    public function getDDateTransaction(): ?\DateTimeInterface
    {
        return $this->d_date_transaction;
    }

    public function setDDateTransaction(?\DateTimeInterface $d_date_transaction): self
    {
        $this->d_date_transaction = $d_date_transaction;

        return $this;
    }

    public function getVAction(): ?string
    {
        return $this->v_action;
    }

    public function setVAction(?string $v_action): self
    {
        $this->v_action = $v_action;

        return $this;
    }

    public function getITypeRef(): ?int
    {
        return $this->i_type_ref;
    }

    public function setITypeRef(?int $i_type_ref): self
    {
        $this->i_type_ref = $i_type_ref;

        return $this;
    }

    public function getIIdRef(): ?int
    {
        return $this->i_id_ref;
    }

    public function setIIdRef(?int $i_id_ref): self
    {
        $this->i_id_ref = $i_id_ref;

        return $this;
    }
}
