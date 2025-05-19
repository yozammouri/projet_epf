<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code_module = null;

    #[ORM\Column(length: 255)]
    private ?string $code_matiere = null;

    #[ORM\Column(length: 255)]
    private ?string $nature = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $details_contenu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $details_groupes = null;

    #[ORM\Column]
    private ?float $ects = null;

    #[ORM\Column]
    private ?float $vh = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_cm = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_cma = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_td = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_tp = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_projet = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_hap = null;

    #[ORM\Column(nullable: true)]
    private ?float $vh_hanp = null;

    #[ORM\Column]
    private ?int $cout_eq_td = null;

    #[ORM\Column]
    private ?int $cout_taux_a = null;

    #[ORM\Column]
    private ?int $cout_taux_b = null;

    #[ORM\Column]
    private ?int $cout_taux_c = null;

    #[ORM\Column]
    private ?int $cout_taux_d = null;

    #[ORM\Column]
    private ?int $cout_taux_e = null;

    #[ORM\Column]
    private ?int $cout_taux_f = null;

    #[ORM\Column(nullable: true)]
    private ?int $cout_taux_h = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UniteEnseignement $uniteEnseignement = null;

    /**
     * @var Collection<int, ActiviteEnseignement>
     */
    #[ORM\OneToMany(targetEntity: ActiviteEnseignement::class, mappedBy: 'module')]
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

    public function getCodeModule(): ?int
    {
        return $this->code_module;
    }

    public function setCodeModule(int $code_module): static
    {
        $this->code_module = $code_module;

        return $this;
    }

    public function getCodeMatiere(): ?string
    {
        return $this->code_matiere;
    }

    public function setCodeMatiere(string $code_matiere): static
    {
        $this->code_matiere = $code_matiere;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

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

    public function getDetailsContenu(): ?string
    {
        return $this->details_contenu;
    }

    public function setDetailsContenu(?string $details_contenu): static
    {
        $this->details_contenu = $details_contenu;

        return $this;
    }

    public function getDetailsGroupes(): ?string
    {
        return $this->details_groupes;
    }

    public function setDetailsGroupes(?string $details_groupes): static
    {
        $this->details_groupes = $details_groupes;

        return $this;
    }

    public function getEcts(): ?float
    {
        return $this->ects;
    }

    public function setEcts(float $ects): static
    {
        $this->ects = $ects;

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

    public function getVhCm(): ?float
    {
        return $this->vh_cm;
    }

    public function setVhCm(float $vh_cm): static
    {
        $this->vh_cm = $vh_cm;

        return $this;
    }

    public function getVhCma(): ?float
    {
        return $this->vh_cma;
    }

    public function setVhCma(float $vh_cma): static
    {
        $this->vh_cma = $vh_cma;

        return $this;
    }

    public function getVhTd(): ?float
    {
        return $this->vh_td;
    }

    public function setVhTd(float $vh_td): static
    {
        $this->vh_td = $vh_td;

        return $this;
    }

    public function getVhTp(): ?float
    {
        return $this->vh_tp;
    }

    public function setVhTp(float $vh_tp): static
    {
        $this->vh_tp = $vh_tp;

        return $this;
    }

    public function getVhProjet(): ?float
    {
        return $this->vh_projet;
    }

    public function setVhProjet(float $vh_projet): static
    {
        $this->vh_projet = $vh_projet;

        return $this;
    }

    public function getVhHap(): ?float
    {
        return $this->vh_hap;
    }

    public function setVhHap(float $vh_hap): static
    {
        $this->vh_hap = $vh_hap;

        return $this;
    }

    public function getVhHanp(): ?float
    {
        return $this->vh_hanp;
    }

    public function setVhHanp(float $vh_hanp): static
    {
        $this->vh_hanp = $vh_hanp;

        return $this;
    }

    public function getCoutEqTd(): ?int
    {
        return $this->cout_eq_td;
    }

    public function setCoutEqTd(int $cout_eq_td): static
    {
        $this->cout_eq_td = $cout_eq_td;

        return $this;
    }

    public function getCoutTauxA(): ?int
    {
        return $this->cout_taux_a;
    }

    public function setCoutTauxA(int $cout_taux_a): static
    {
        $this->cout_taux_a = $cout_taux_a;

        return $this;
    }

    public function getCoutTauxB(): ?int
    {
        return $this->cout_taux_b;
    }

    public function setCoutTauxB(int $cout_taux_b): static
    {
        $this->cout_taux_b = $cout_taux_b;

        return $this;
    }

    public function getCoutTauxC(): ?int
    {
        return $this->cout_taux_c;
    }

    public function setCoutTauxC(int $cout_taux_c): static
    {
        $this->cout_taux_c = $cout_taux_c;

        return $this;
    }

    public function getCoutTauxD(): ?int
    {
        return $this->cout_taux_d;
    }

    public function setCoutTauxD(int $cout_taux_d): static
    {
        $this->cout_taux_d = $cout_taux_d;

        return $this;
    }

    public function getCoutTauxF(): ?int
    {
        return $this->cout_taux_f;
    }

    public function setCoutTauxF(int $cout_taux_f): static
    {
        $this->cout_taux_f = $cout_taux_f;

        return $this;
    }

    public function getCoutTauxE(): ?int
    {
        return $this->cout_taux_e;
    }

    public function setCoutTauxE(int $cout_taux_e): static
    {
        $this->cout_taux_e = $cout_taux_e;

        return $this;
    }

    public function getCoutTauxH(): ?int
    {
        return $this->cout_taux_h;
    }

    public function setCoutTauxH(?int $cout_taux_h): static
    {
        $this->cout_taux_h = $cout_taux_h;

        return $this;
    }

    public function getUniteEnseignement(): ?UniteEnseignement
    {
        return $this->uniteEnseignement;
    }

    public function setUniteEnseignement(?UniteEnseignement $uniteEnseignement): static
    {
        $this->uniteEnseignement = $uniteEnseignement;

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
            $activiteEnseignement->setModule($this);
        }

        return $this;
    }

    public function removeActiviteEnseignement(ActiviteEnseignement $activiteEnseignement): static
    {
        if ($this->activiteEnseignements->removeElement($activiteEnseignement)) {
            // set the owning side to null (unless already changed)
            if ($activiteEnseignement->getModule() === $this) {
                $activiteEnseignement->setModule(null);
            }
        }

        return $this;
    }
}
