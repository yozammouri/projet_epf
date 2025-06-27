<?php

namespace App\Entity;

use App\Repository\CoordinateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CoordinateurRepository::class)]
class Coordinateur // extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['coordinateur:read'])]
    private ?int $id_coordinateur = null;

    // #[ORM\Column(length: 255)]
    // private ?string $nom = null;

    // #[ORM\Column(length: 255)]
    // private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['coordinateur:read'])]
    private ?string $adresse = null;

    #[ORM\Column(length: 20)]
    #[Groups(['coordinateur:read'])]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    #[Groups(['coordinateur:read'])]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    #[Groups(['coordinateur:read'])]
    private ?string $photo = null;

    #[ORM\OneToOne(inversedBy: "coordinateur", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['coordinateur:read'])]
    private User $user;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'coordinateurs')]
    #[ORM\JoinTable(name: "coordinateur_formation",
    joinColumns: [
        new ORM\JoinColumn(name: "coordinateur_id", referencedColumnName: "id_coordinateur")
    ],
    inverseJoinColumns: [
        new ORM\JoinColumn(name: "formation_id", referencedColumnName: "id")
    ]
    )]
    #[Groups(['coordinateur:read'])]
    private Collection $formations;

    /**
     * @var Collection<int, Syllabus>
     */
    #[ORM\ManyToMany(targetEntity: Syllabus::class, inversedBy: 'coordinateurs')]
    #[ORM\JoinTable(name: "coordinateur_syllabus",
        joinColumns: [
            new ORM\JoinColumn(name: "coordinateur_id", referencedColumnName: "id_coordinateur")
        ],
        inverseJoinColumns: [
            new ORM\JoinColumn(name: "syllabus_id", referencedColumnName: "id")
        ]
    )]
    #[Groups(['coordinateur:read'])]
    private Collection $syllabuss;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->syllabuss = new ArrayCollection();
    }

    public function getIdCoordinateur(): ?int
    {
        return $this->id_coordinateur;
    }

    public function setIdCoordinateur(int $id_coordinateur): static
    {
        $this->id_coordinateur = $id_coordinateur;

        return $this;
    }

    // public function getNom(): ?string
    // {
    //     return $this->nom;
    // }

    // public function setNom(string $nom): static
    // {
    //     $this->nom = $nom;

    //     return $this;
    // }

    // public function getPrenom(): ?string
    // {
    //     return $this->prenom;
    // }

    // public function setPrenom(string $prenom): static
    // {
    //     $this->prenom = $prenom;

    //     return $this;
    // }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
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
