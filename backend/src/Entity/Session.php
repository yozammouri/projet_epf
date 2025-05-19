<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_session = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_demarrage = null;

    #[ORM\Column]
    private ?int $effectif = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promotion $promotion = null;

    /**
     * @var Collection<int, Semestre>
     */
    #[ORM\OneToMany(targetEntity: Semestre::class, mappedBy: 'session')]
    private Collection $semestres;

    /**
     * @var Collection<int, Apprenant>
     */
    #[ORM\ManyToMany(targetEntity: Apprenant::class, mappedBy: 'session')]
    private Collection $apprenants;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
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

    public function getLibelleSession(): ?string
    {
        return $this->libelle_session;
    }

    public function setLibelleSession(string $libelle_session): static
    {
        $this->libelle_session = $libelle_session;

        return $this;
    }

    public function getDateDemarrage(): ?\DateTimeImmutable
    {
        return $this->date_demarrage;
    }

    public function setDateDemarrage(\DateTimeImmutable $date_demarrage): static
    {
        $this->date_demarrage = $date_demarrage;

        return $this;
    }

    public function getEffectif(): ?int
    {
        return $this->effectif;
    }

    public function setEffectif(int $effectif): static
    {
        $this->effectif = $effectif;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): static
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * @return Collection<int, Semestre>
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    public function addSemestre(Semestre $semestre): static
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres->add($semestre);
            $semestre->setSession($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): static
    {
        if ($this->semestres->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getSession() === $this) {
                $semestre->setSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Apprenant>
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): static
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants->add($apprenant);
            $apprenant->addSession($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): static
    {
        if ($this->apprenants->removeElement($apprenant)) {
            $apprenant->removeSession($this);
        }

        return $this;
    }
}
