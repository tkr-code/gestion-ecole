<?php

namespace App\Entity;

use App\Repository\EtablissementProvenanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtablissementProvenanceRepository::class)
 */
class EtablissementProvenance
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee_academique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
