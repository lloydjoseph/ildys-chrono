<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modification_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $entry_nb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entry_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modification_type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(?int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(?\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    public function getEntryNb(): ?int
    {
        return $this->entry_nb;
    }

    public function setEntryNb(?int $entry_nb): self
    {
        $this->entry_nb = $entry_nb;

        return $this;
    }

    public function getEntryType(): ?string
    {
        return $this->entry_type;
    }

    public function setEntryType(?string $entry_type): self
    {
        $this->entry_type = $entry_type;

        return $this;
    }

    public function getModificationType(): ?string
    {
        return $this->modification_type;
    }

    public function setModificationType(?string $modification_type): self
    {
        $this->modification_type = $modification_type;

        return $this;
    }
}
