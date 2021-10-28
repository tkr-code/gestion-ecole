<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $occupation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $signature;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;

    /**
     * @ORM\ManyToOne(targetEntity=EtablissementProvenance::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Provenance;

    /**
     * @ORM\ManyToOne(targetEntity=ParentEtudiant::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parent_etudiant;

    /**
     * @ORM\OneToOne(targetEntity=DossierEtudiant::class, inversedBy="etudiant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\OneToMany(targetEntity=Bulletin::class, mappedBy="etudiant")
     */
    private $bulletins;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="etudiant")
     */
    private $notes;

    /**
     * @ORM\ManyToMany(targetEntity=Cour::class, inversedBy="etudiants")
     */
    private $fiche_de_presence;

    public function __construct()
    {
        $this->bulletins = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->fiche_de_presence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(?string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getProvenance(): ?EtablissementProvenance
    {
        return $this->Provenance;
    }

    public function setProvenance(?EtablissementProvenance $Provenance): self
    {
        $this->Provenance = $Provenance;

        return $this;
    }

    public function getParentEtudiant(): ?ParentEtudiant
    {
        return $this->parent_etudiant;
    }

    public function setParentEtudiant(?ParentEtudiant $parent_etudiant): self
    {
        $this->parent_etudiant = $parent_etudiant;

        return $this;
    }

    public function getDossier(): ?DossierEtudiant
    {
        return $this->dossier;
    }

    public function setDossier(DossierEtudiant $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * @return Collection|Bulletin[]
     */
    public function getBulletins(): Collection
    {
        return $this->bulletins;
    }

    public function addBulletin(Bulletin $bulletin): self
    {
        if (!$this->bulletins->contains($bulletin)) {
            $this->bulletins[] = $bulletin;
            $bulletin->setEtudiant($this);
        }

        return $this;
    }

    public function removeBulletin(Bulletin $bulletin): self
    {
        if ($this->bulletins->removeElement($bulletin)) {
            // set the owning side to null (unless already changed)
            if ($bulletin->getEtudiant() === $this) {
                $bulletin->setEtudiant(null);
            }
        }

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
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cour[]
     */
    public function getFicheDePresence(): Collection
    {
        return $this->fiche_de_presence;
    }

    public function addFicheDePresence(Cour $ficheDePresence): self
    {
        if (!$this->fiche_de_presence->contains($ficheDePresence)) {
            $this->fiche_de_presence[] = $ficheDePresence;
        }

        return $this;
    }

    public function removeFicheDePresence(Cour $ficheDePresence): self
    {
        $this->fiche_de_presence->removeElement($ficheDePresence);

        return $this;
    }
}
