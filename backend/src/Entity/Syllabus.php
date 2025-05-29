<?php

namespace App\Entity;

use App\Repository\SyllabusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SyllabusRepository::class)]
class Syllabus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\OneToOne(inversedBy: 'syllabus', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semestre $semestre = null;

    /**
     * @var Collection<int, Coordinateur>
     */
    #[ORM\ManyToMany(targetEntity: Coordinateur::class, mappedBy: 'syllabuss')]
    private Collection $coordinateurs;

    /**
     * @var Collection<int, UniteEnseignement>
     */
    #[ORM\OneToMany(targetEntity: UniteEnseignement::class, mappedBy: 'syllabus')]
    private Collection $uniteEnseignements;

    public function __construct()
    {
        $this->coordinateurs = new ArrayCollection();
        $this->uniteEnseignements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(Semestre $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * @return Collection<int, Coordinateur>
     */
    public function getCoordinateurs(): Collection
    {
        return $this->coordinateurs;
    }

    public function addCoordinateur(Coordinateur $coordinateur): static
    {
        if (!$this->coordinateurs->contains($coordinateur)) {
            $this->coordinateurs->add($coordinateur);
            $coordinateur->addSyllabuss($this);
        }

        return $this;
    }

    public function removeCoordinateur(Coordinateur $coordinateur): static
    {
        if ($this->coordinateurs->removeElement($coordinateur)) {
            $coordinateur->removeSyllabuss($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UniteEnseignement>
     */
    public function getUniteEnseignements(): Collection
    {
        return $this->uniteEnseignements;
    }

    public function addUniteEnseignement(UniteEnseignement $uniteEnseignement): static
    {
        if (!$this->uniteEnseignements->contains($uniteEnseignement)) {
            $this->uniteEnseignements->add($uniteEnseignement);
            $uniteEnseignement->setSyllabus($this);
        }

        return $this;
    }

    public function removeUniteEnseignement(UniteEnseignement $uniteEnseignement): static
    {
        if ($this->uniteEnseignements->removeElement($uniteEnseignement)) {
            // set the owning side to null (unless already changed)
            if ($uniteEnseignement->getSyllabus() === $this) {
                $uniteEnseignement->setSyllabus(null);
            }
        }

        return $this;
    }
}
