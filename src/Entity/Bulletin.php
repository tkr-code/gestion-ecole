<?php

namespace App\Entity;

use App\Repository\BulletinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BulletinRepository::class)
 */
class Bulletin
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
    private $numero_semestre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $moyenne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee_academique;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="bulletins")
     */
    private $etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="bulletin")
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSemestre(): ?int
    {
        return $this->numero_semestre;
    }

    public function setNumeroSemestre(int $numero_semestre): self
    {
        $this->numero_semestre = $numero_semestre;

        return $this;
    }

    public function getMoyenne(): ?string
    {
        return $this->moyenne;
    }

    public function setMoyenne(string $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getAnneeAcademique(): ?string
    {
        return $this->annee_academique;
    }

    public function setAnneeAcademique(string $annee_academique): self
    {
        $this->annee_academique = $annee_academique;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setBulletin($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getBulletin() === $this) {
                $note->setBulletin(null);
            }
        }

        return $this;
    }
}
