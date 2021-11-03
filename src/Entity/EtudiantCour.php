<?php

namespace App\Entity;

use App\Repository\EtudiantCourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantCourRepository::class)
 */
class EtudiantCour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $presence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motif;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="etudiantCours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity=Cour::class, inversedBy="etudiantCours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresence(): ?bool
    {
        return $this->presence;
    }

    public function setPresence(bool $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtudiants(): ?Etudiant
    {
        return $this->etudiants;
    }

    public function setEtudiants(?Etudiant $etudiants): self
    {
        $this->etudiants = $etudiants;

        return $this;
    }

    public function getCours(): ?Cour
    {
        return $this->cours;
    }

    public function setCours(?Cour $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
