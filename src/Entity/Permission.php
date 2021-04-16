<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermissionRepository::class)
 */
class Permission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $i_id_perm;

    /**
     * @ORM\Column(type="integer")
     */
    private $i_id_user;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_ajout_courrier;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_modif_courrier;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_suppr_courrier;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_ajout_note_info;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_modif_note_info;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_suppr_note_info;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_ajout_note_serv;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_modif_note_serv;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $b_suppr_note_serv;

    public function getIIdPerm(): ?int
    {
        return $this->i_id_perm;
    }

    public function getIIdUser(): ?int
    {
        return $this->i_id_user;
    }

    public function setIIdUser(int $i_id_user): self
    {
        $this->i_id_user = $i_id_user;

        return $this;
    }

    public function getBAjoutCourrier(): ?bool
    {
        return $this->b_ajout_courrier;
    }

    public function setBAjoutCourrier(?bool $b_ajout_courrier): self
    {
        $this->b_ajout_courrier = $b_ajout_courrier;

        return $this;
    }

    public function getBModifCourrier(): ?bool
    {
        return $this->b_modif_courrier;
    }

    public function setBModifCourrier(?bool $b_modif_courrier): self
    {
        $this->b_modif_courrier = $b_modif_courrier;

        return $this;
    }

    public function getBSupprCourrier(): ?bool
    {
        return $this->b_suppr_courrier;
    }

    public function setBSupprCourrier(?bool $b_suppr_courrier): self
    {
        $this->b_suppr_courrier = $b_suppr_courrier;

        return $this;
    }

    public function getBAjoutNoteInfo(): ?bool
    {
        return $this->b_ajout_note_info;
    }

    public function setBAjoutNoteInfo(?bool $b_ajout_note_info): self
    {
        $this->b_ajout_note_info = $b_ajout_note_info;

        return $this;
    }

    public function getBModifNoteInfo(): ?bool
    {
        return $this->b_modif_note_info;
    }

    public function setBModifNoteInfo(?bool $b_modif_note_info): self
    {
        $this->b_modif_note_info = $b_modif_note_info;

        return $this;
    }

    public function getBSupprNoteInfo(): ?bool
    {
        return $this->b_suppr_note_info;
    }

    public function setBSupprNoteInfo(?bool $b_suppr_note_info): self
    {
        $this->b_suppr_note_info = $b_suppr_note_info;

        return $this;
    }

    public function getBAjoutNoteServ(): ?bool
    {
        return $this->b_ajout_note_serv;
    }

    public function setBAjoutNoteServ(?bool $b_ajout_note_serv): self
    {
        $this->b_ajout_note_serv = $b_ajout_note_serv;

        return $this;
    }

    public function getBModifNoteServ(): ?bool
    {
        return $this->b_modif_note_serv;
    }

    public function setBModifNoteServ(?bool $b_modif_note_serv): self
    {
        $this->b_modif_note_serv = $b_modif_note_serv;

        return $this;
    }

    public function getBSupprNoteServ(): ?bool
    {
        return $this->b_suppr_note_serv;
    }

    public function setBSupprNoteServ(?bool $b_suppr_note_serv): self
    {
        $this->b_suppr_note_serv = $b_suppr_note_serv;

        return $this;
    }
}
