<?php

namespace App\Entity;

use App\Repository\NoteInformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteInformationRepository::class)
 */
class NoteInformation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $i_id_note;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $i_numero;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $d_date_creation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $i_id_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $v_libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $v_service;

    public function getIIdNote(): ?int
    {
        return $this->i_id_note;
    }

    public function getINumero(): ?int
    {
        return $this->i_numero;
    }

    public function setINumero(?int $i_numero): self
    {
        $this->i_numero = $i_numero;

        return $this;
    }

    public function getDDateCreation(): ?\DateTimeInterface
    {
        return $this->d_date_creation;
    }

    public function setDDateCreation(?\DateTimeInterface $d_date_creation): self
    {
        $this->d_date_creation = $d_date_creation;

        return $this;
    }

    public function getIIDUser(): ?int
    {
        return $this->i_id_user;
    }

    public function setIIdUser(?int $i_id_user): self
    {
        $this->i_id_user = $i_id_user;

        return $this;
    }

    public function getVLibelle(): ?string
    {
        return $this->v_libelle;
    }

    public function setVLibelle(?string $v_libelle): self
    {
        $this->v_libelle = $v_libelle;

        return $this;
    }

    public function getVService(): ?string
    {
        return $this->v_service;
    }

    public function setVService(?string $v_service): self
    {
        $this->v_service = $v_service;

        return $this;
    }
}
