<?php

namespace App\Entity;

use App\Repository\CoordinateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoordinateurRepository::class)]
class Coordinateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'coordinateurs')]
    private Collection $formations;

    /**
     * @var Collection<int, Syllabus>
     */
    #[ORM\ManyToMany(targetEntity: Syllabus::class, inversedBy: 'coordinateurs')]
    private Collection $syllabuss;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->syllabuss = new ArrayCollection();
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

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    /**
     * @return Collection<int, Syllabus>
     */
    public function getSyllabuss(): Collection
    {
        return $this->syllabuss;
    }

    public function addSyllabuss(Syllabus $syllabuss): static
    {
        if (!$this->syllabuss->contains($syllabuss)) {
            $this->syllabuss->add($syllabuss);
        }

        return $this;
    }

    public function removeSyllabuss(Syllabus $syllabuss): static
    {
        $this->syllabuss->removeElement($syllabuss);

        return $this;
    }
}
