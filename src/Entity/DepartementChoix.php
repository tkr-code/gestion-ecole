<?php

namespace App\Entity;

use App\Repository\DepartementChoixRepository;
use Doctrine\ORM\Mapping as ORM;


class DepartementChoix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="object")
     */
    private $departement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setDepartement($departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
