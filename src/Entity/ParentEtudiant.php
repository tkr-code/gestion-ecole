<?php

namespace App\Entity;

use App\Repository\ParentEtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParentEtudiantRepository::class)
 */
class ParentEtudiant
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
    private $nom_pere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_pere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession_pere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_mere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_mere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession_mere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_pere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_mere;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="parent_etudiant")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPere(): ?string
    {
        return $this->nom_pere;
    }

    public function setNomPere(string $nom_pere): self
    {
        $this->nom_pere = $nom_pere;

        return $this;
    }

    public function getPrenomPere(): ?string
    {
        return $this->prenom_pere;
    }

    public function setPrenomPere(string $prenom_pere): self
    {
        $this->prenom_pere = $prenom_pere;

        return $this;
    }

    public function getProfessionPere(): ?string
    {
        return $this->profession_pere;
    }

    public function setProfessionPere(?string $profession_pere): self
    {
        $this->profession_pere = $profession_pere;

        return $this;
    }

    public function getPrenomMere(): ?string
    {
        return $this->prenom_mere;
    }

    public function setPrenomMere(string $prenom_mere): self
    {
        $this->prenom_mere = $prenom_mere;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->nom_mere;
    }

    public function setNomMere(string $nom_mere): self
    {
        $this->nom_mere = $nom_mere;

        return $this;
    }

    public function getProfessionMere(): ?string
    {
        return $this->profession_mere;
    }

    public function setProfessionMere(?string $profession_mere): self
    {
        $this->profession_mere = $profession_mere;

        return $this;
    }

    public function getTelPere(): ?string
    {
        return $this->tel_pere;
    }

    public function setTelPere(?string $tel_pere): self
    {
        $this->tel_pere = $tel_pere;

        return $this;
    }

    public function getTelMere(): ?string
    {
        return $this->tel_mere;
    }

    public function setTelMere(?string $tel_mere): self
    {
        $this->tel_mere = $tel_mere;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setParentEtudiant($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getParentEtudiant() === $this) {
                $etudiant->setParentEtudiant(null);
            }
        }

        return $this;
    }
}
