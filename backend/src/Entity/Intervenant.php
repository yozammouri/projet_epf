<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $civilite = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $mode_paiement = null;

    #[ORM\Column(length: 255)]
    private ?string $etablissement_origine = null;

    /**
     * @var Collection<int, ActiviteEnseignement>
     */
    #[ORM\ManyToMany(targetEntity: ActiviteEnseignement::class, mappedBy: 'intervenants')]
    private Collection $activiteEnseignements;

    public function __construct()
    {
        $this->activiteEnseignements = new ArrayCollection();
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

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(string $mode_paiement): static
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }

    public function getEtablissementOrigine(): ?string
    {
        return $this->etablissement_origine;
    }

    public function setEtablissementOrigine(string $etablissement_origine): static
    {
        $this->etablissement_origine = $etablissement_origine;

        return $this;
    }

    /**
     * @return Collection<int, ActiviteEnseignement>
     */
    public function getActiviteEnseignements(): Collection
    {
        return $this->activiteEnseignements;
    }

    public function addActiviteEnseignement(ActiviteEnseignement $activiteEnseignement): static
    {
        if (!$this->activiteEnseignements->contains($activiteEnseignement)) {
            $this->activiteEnseignements->add($activiteEnseignement);
            $activiteEnseignement->addIntervenant($this);
        }

        return $this;
    }

    public function removeActiviteEnseignement(ActiviteEnseignement $activiteEnseignement): static
    {
        if ($this->activiteEnseignements->removeElement($activiteEnseignement)) {
            $activiteEnseignement->removeIntervenant($this);
        }

        return $this;
    }
}
