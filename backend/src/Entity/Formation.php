<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Promotion>
     */
    #[ORM\OneToMany(targetEntity: Promotion::class, mappedBy: 'formation')]
    private Collection $promotions;

    /**
     * @var Collection<int, Catalogue>
     */
    #[ORM\ManyToMany(targetEntity: Catalogue::class, inversedBy: 'formations')]
    private Collection $catalogue;

    #[ORM\Column(type: 'text')]
    private ?string $objectifs = null;

    #[ORM\Column(length: 255)]
    private ?string $prerequis = null;

    #[ORM\Column(type: 'text')]
    private ?string $public = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column]
    private ?int $volume_horaire = null;

    #[ORM\Column(length: 255)]
    private ?string $lieux = null;

    /**
     * @var Collection<int, Coordinateur>
     */
    #[ORM\ManyToMany(targetEntity: Coordinateur::class, mappedBy: 'formations')]
    private Collection $coordinateurs;

    public function __construct()
    {
        $this->promotions = new ArrayCollection();
        $this->catalogue = new ArrayCollection();
        $this->coordinateurs = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): static
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions->add($promotion);
            $promotion->setFormation($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): static
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getFormation() === $this) {
                $promotion->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Catalogue>
     */
    public function getCatalogue(): Collection
    {
        return $this->catalogue;
    }

    public function addCatalogue(Catalogue $catalogue): static
    {
        if (!$this->catalogue->contains($catalogue)) {
            $this->catalogue->add($catalogue);
        }

        return $this;
    }

    public function removeCatalogue(Catalogue $catalogue): static
    {
        $this->catalogue->removeElement($catalogue);

        return $this;
    }

    public function getObjectifs(): ?string
    {
        return $this->objectifs;
    }

    public function setObjectifs(string $objectifs): static
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getPublic(): ?string
    {
        return $this->public;
    }

    public function setPublic(string $public): static
    {
        $this->public = $public;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getVolumeHoraire(): ?int
    {
        return $this->volume_horaire;
    }

    public function setVolumeHoraire(int $volume_horaire): static
    {
        $this->volume_horaire = $volume_horaire;

        return $this;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): static
    {
        $this->lieux = $lieux;

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
            $coordinateur->addFormation($this);
        }

        return $this;
    }

    public function removeCoordinateur(Coordinateur $coordinateur): static
    {
        if ($this->coordinateurs->removeElement($coordinateur)) {
            $coordinateur->removeFormation($this);
        }

        return $this;
    }
}
