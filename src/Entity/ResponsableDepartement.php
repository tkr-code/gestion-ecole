<?php

namespace App\Entity;

use App\Repository\ResponsableDepartementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponsableDepartementRepository::class)
 */
class ResponsableDepartement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_entre_fonction;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_sortie_fonction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntreFonction(): ?\DateTimeInterface
    {
        return $this->date_entre_fonction;
    }

    public function setDateEntreFonction(\DateTimeInterface $date_entre_fonction): self
    {
        $this->date_entre_fonction = $date_entre_fonction;

        return $this;
    }

    public function getDateSortieFonction(): ?\DateTimeInterface
    {
        return $this->date_sortie_fonction;
    }

    public function setDateSortieFonction(?\DateTimeInterface $date_sortie_fonction): self
    {
        $this->date_sortie_fonction = $date_sortie_fonction;

        return $this;
    }
}
