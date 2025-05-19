<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestreRepository::class)]
class Semestre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_debut = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_fin = null;

    #[ORM\ManyToOne(inversedBy: 'semestres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\OneToOne(mappedBy: 'semestre', cascade: ['persist', 'remove'])]
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeImmutable $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeImmutable $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getSyllabus(): ?Syllabus
    {
        return $this->syllabus;
    }

    public function setSyllabus(Syllabus $syllabus): static
    {
        // set the owning side of the relation if necessary
        if ($syllabus->getSemestre() !== $this) {
            $syllabus->setSemestre($this);
        }

        $this->syllabus = $syllabus;

        return $this;
    }
}
