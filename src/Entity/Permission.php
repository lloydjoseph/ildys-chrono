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
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $courrier_add;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $courrier_mod;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $courrier_del;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $information_add;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $information_mod;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $information_del;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $service_add;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $service_mod;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"}, nullable=true)
     */
    private $service_del;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getCourrierAdd(): ?int
    {
        return $this->courrier_add;
    }

    public function setCourrierAdd(?int $courrier_add): self
    {
        $this->courrier_add = $courrier_add;

        return $this;
    }

    public function getCourrierMod(): ?int
    {
        return $this->courrier_mod;
    }

    public function setCourrierMod(?int $courrier_mod): self
    {
        $this->courrier_mod = $courrier_mod;

        return $this;
    }

    public function getCourrierDel(): ?int
    {
        return $this->courrier_del;
    }

    public function setCourrierDel(?int $courrier_del): self
    {
        $this->courrier_del = $courrier_del;

        return $this;
    }

    public function getInformationAdd(): ?int
    {
        return $this->information_add;
    }

    public function setInformationAdd(?int $information_add): self
    {
        $this->information_add = $information_add;

        return $this;
    }

    public function getInformationMod(): ?int
    {
        return $this->information_mod;
    }

    public function setInformationMod(?int $information_mod): self
    {
        $this->information_mod = $information_mod;

        return $this;
    }

    public function getInformationDel(): ?int
    {
        return $this->information_del;
    }

    public function setInformationDel(?int $information_del): self
    {
        $this->information_del = $information_del;

        return $this;
    }

    public function getServiceAdd(): ?int
    {
        return $this->service_add;
    }

    public function setServiceAdd(?int $service_add): self
    {
        $this->service_add = $service_add;

        return $this;
    }

    public function getServiceMod(): ?int
    {
        return $this->service_mod;
    }

    public function setServiceMod(?int $service_mod): self
    {
        $this->service_mod = $service_mod;

        return $this;
    }

    public function getServiceDel(): ?int
    {
        return $this->service_del;
    }

    public function setServiceDel(?int $service_del): self
    {
        $this->service_del = $service_del;

        return $this;
    }
}
