<?php

namespace App\Entity;

use App\Repository\ReglementFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglementFormationRepository::class)
 */
class ReglementFormation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mode_reglement;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant_a_regler;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getModeReglement(): ?string
    {
        return $this->mode_reglement;
    }

    public function setModeReglement(string $mode_reglement): self
    {
        $this->mode_reglement = $mode_reglement;

        return $this;
    }

    public function getMontantARegler(): ?int
    {
        return $this->montant_a_regler;
    }

    public function setMontantARegler(int $montant_a_regler): self
    {
        $this->montant_a_regler = $montant_a_regler;

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
}
