<?php

namespace App\Entity;

use App\Repository\FichePresenceEtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FichePresenceEtudiantRepository::class)
 */
class FichePresenceEtudiant
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
    private $motifAbsence;

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

    public function getMotifAbsence(): ?string
    {
        return $this->motifAbsence;
    }

    public function setMotifAbsence(?string $motifAbsence): self
    {
        $this->motifAbsence = $motifAbsence;

        return $this;
    }
}
