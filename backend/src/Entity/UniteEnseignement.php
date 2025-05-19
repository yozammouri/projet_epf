<?php

namespace App\Entity;

use App\Repository\UniteEnseignementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteEnseignementRepository::class)]
class UniteEnseignement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_ue = null;

    #[ORM\Column(length: 255)]
    private ?string $nature = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule_fr = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule_en = null;

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

    #[ORM\Column(nullable: true)]
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

    #[ORM\Column]
    private ?int $cout_taux_h = null;

    #[ORM\Column]
    private ?int $coef = null;

    #[ORM\ManyToOne(inversedBy: 'uniteEnseignements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Syllabus $syllabus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCodeUe(): ?string
    {
        return $this->code_ue;
    }

    public function setCodeUe(string $code_ue): static
    {
        $this->code_ue = $code_ue;

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

    public function getIntituleFr(): ?string
    {
        return $this->intitule_fr;
    }

    public function setIntituleFr(string $intitule_fr): static
    {
        $this->intitule_fr = $intitule_fr;

        return $this;
    }

    public function getIntituleEn(): ?string
    {
        return $this->intitule_en;
    }

    public function setIntituleEn(string $intitule_en): static
    {
        $this->intitule_en = $intitule_en;

        return $this;
    }

    public function getEcts(): ?int
    {
        return $this->ects;
    }

    public function setEcts(int $ects): static
    {
        $this->ects = $ects;

        return $this;
    }

    public function getVh(): ?int
    {
        return $this->vh;
    }

    public function setVh(int $vh): static
    {
        $this->vh = $vh;

        return $this;
    }

    public function getVhCm(): ?int
    {
        return $this->vh_cm;
    }

    public function setVhCm(int $vh_cm): static
    {
        $this->vh_cm = $vh_cm;

        return $this;
    }

    public function getVhCma(): ?int
    {
        return $this->vh_cma;
    }

    public function setVhCma(int $vh_cma): static
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

    public function getCoutTauxE(): ?int
    {
        return $this->cout_taux_e;
    }

    public function setCoutTauxE(int $cout_taux_e): static
    {
        $this->cout_taux_e = $cout_taux_e;

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

    public function getCoutTauxH(): ?int
    {
        return $this->cout_taux_h;
    }

    public function setCoutTauxH(int $cout_taux_h): static
    {
        $this->cout_taux_h = $cout_taux_h;

        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): static
    {
        $this->coef = $coef;

        return $this;
    }

    public function getSyllabus(): ?Syllabus
    {
        return $this->syllabus;
    }

    public function setSyllabus(?Syllabus $syllabus): static
    {
        $this->syllabus = $syllabus;

        return $this;
    }
}
