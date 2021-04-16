<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $i_id_user;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $v_identifiant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $v_prenom_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $v_nom_user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $b_admin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $b_actif;

    public function getIIdUser(): ?int
    {
        return $this->i_id_user;
    }

    public function getVIdentifiant(): ?string
    {
        return $this->v_identifiant;
    }

    public function setVIdentifiant(?string $v_identifiant): self
    {
        $this->v_identifiant = $v_identifiant;

        return $this;
    }

    public function getVPrenomUser(): ?string
    {
        return $this->v_prenom_user;
    }

    public function setVPrenomUser(?string $v_prenom_user): self
    {
        $this->v_prenom_user = $v_prenom_user;

        return $this;
    }

    public function getVNomUser(): ?string
    {
        return $this->v_nom_user;
    }

    public function setVNomUser(?string $v_nom_user): self
    {
        $this->v_nom_user = $v_nom_user;

        return $this;
    }

    public function getBAdmin(): ?bool
    {
        return $this->b_admin;
    }

    public function setBAdmin(?bool $b_admin): self
    {
        $this->b_admin = $b_admin;

        return $this;
    }

    public function getBActif(): ?bool
    {
        return $this->b_actif;
    }

    public function setBActif(?bool $b_actif): self
    {
        $this->b_actif = $b_actif;

        return $this;
    }
}