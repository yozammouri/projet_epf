<?php

namespace App\Entity;

use App\Repository\ActiviteEnseignementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteEnseignementRepository::class)]
class ActiviteEnseignement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column]
    private ?float $vh = null;

    #[ORM\Column]
    private ?float $th = null;

    #[ORM\Column(length: 255)]
    private ?string $langue = null;

    #[ORM\Column]
    private ?int $nb_seance = null;

    #[ORM\Column]
    private ?int $nb_groupe = null;

    #[ORM\ManyToOne(inversedBy: 'activiteEnseignements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    /**
     * @var Collection<int, Intervenant>
     */
    #[ORM\ManyToMany(targetEntity: Intervenant::class, inversedBy: 'activiteEnseignements')]
    #[ORM\JoinTable(
    name: 'activite_enseignement_intervenant',
    joinColumns: [
        new ORM\JoinColumn(name: 'activite_enseignement_id', referencedColumnName: 'id')
    ],
    inverseJoinColumns: [
        new ORM\JoinColumn(name: 'intervenant_id', referencedColumnName: 'id_intervenant')
    ]
    )]
    private Collection $intervenants;

    public function __construct()
    {
        $this->intervenants = new ArrayCollection();
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

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getVh(): ?float
    {
        return $this->vh;
    }

    public function setVh(float $vh): static
    {
        $this->vh = $vh;

        return $this;
    }

    public function getTh(): ?float
    {
        return $this->th;
    }

    public function setTh(float $th): static
    {
        $this->th = $th;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getNbSeance(): ?int
    {
        return $this->nb_seance;
    }

    public function setNbSeance(int $nb_seance): static
    {
        $this->nb_seance = $nb_seance;

        return $this;
    }

    public function getNbGroupe(): ?int
    {
        return $this->nb_groupe;
    }

    public function setNbGroupe(int $nb_groupe): static
    {
        $this->nb_groupe = $nb_groupe;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Intervenant $intervenant): static
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): static
    {
        $this->intervenants->removeElement($intervenant);

        return $this;
    }
}
