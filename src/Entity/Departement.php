<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=ResponsableDepartement::class, mappedBy="departement")
     */
    private $reponsable;

    /**
     * @ORM\OneToMany(targetEntity=Filiere::class, mappedBy="departement")
     */
    private $filiere;

    public function __construct()
    {
        $this->reponsable = new ArrayCollection();
        $this->filiere = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|ResponsableDepartement[]
     */
    public function getReponsable(): Collection
    {
        return $this->reponsable;
    }

    public function addReponsable(ResponsableDepartement $reponsable): self
    {
        if (!$this->reponsable->contains($reponsable)) {
            $this->reponsable[] = $reponsable;
            $reponsable->setDepartement($this);
        }

        return $this;
    }

    public function removeReponsable(ResponsableDepartement $reponsable): self
    {
        if ($this->reponsable->removeElement($reponsable)) {
            // set the owning side to null (unless already changed)
            if ($reponsable->getDepartement() === $this) {
                $reponsable->setDepartement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFiliere(): Collection
    {
        return $this->filiere;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filiere->contains($filiere)) {
            $this->filiere[] = $filiere;
            $filiere->setDepartement($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->filiere->removeElement($filiere)) {
            // set the owning side to null (unless already changed)
            if ($filiere->getDepartement() === $this) {
                $filiere->setDepartement(null);
            }
        }

        return $this;
    }
}
