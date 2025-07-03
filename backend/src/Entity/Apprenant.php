<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;


#[ORM\Entity(repositoryClass: ApprenantRepository::class)]
class Apprenant // extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['apprenant:read'])]
    private ?int $id_apprenant = null;

    // #[ORM\Column(length: 255)]
    // private ?string $nom = null;

    // #[ORM\Column(length: 255)]
    // private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups(['apprenant:read'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private ?\DateTimeImmutable $date_naissance = null;

    #[ORM\Column(length: 20)]
    #[Groups(['apprenant:read'])]
    private ?string $tel = null;

    // #[ORM\Column(length: 255)]
    // private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $nationnalite = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $profession = null;

    #[ORM\Column]
    #[Groups(['apprenant:read'])]
    private ?int $anne_experience = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $dernier_diplome = null;

    #[ORM\Column(length: 255)]
    #[Groups(['apprenant:read'])]
    private ?string $photo = null;

    #[ORM\OneToOne(inversedBy: "apprenant", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['apprenant:read'])]
    private User $user;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'apprenants')]
    #[ORM\JoinTable(
    name: 'apprenant_session',
    joinColumns: [
        new ORM\JoinColumn(name: 'apprenant_id', referencedColumnName: 'id_apprenant')
    ],
    inverseJoinColumns: [
        new ORM\JoinColumn(name: 'session_id', referencedColumnName: 'id')
    ]
    )]
    #[Groups(['apprenant:read'])]
    private Collection $sessions;

    
    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getIdApprenant(): ?int
    {
        return $this->id_apprenant;
    }

    public function setIdApprenant(int $id_apprenant): static
    {
        $this->id_apprenant = $id_apprenant;

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

    public function getDateNaissance(): ?\DateTimeImmutable
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeImmutable $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

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

    // public function getEmail(): ?string
    // {
    //     return $this->email;
    // }

    // public function setEmail(string $email): static
    // {
    //     $this->email = $email;

    //     return $this;
    // }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getNationnalite(): ?string
    {
        return $this->nationnalite;
    }

    public function setNationnalite(string $nationnalite): static
    {
        $this->nationnalite = $nationnalite;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getAnneExperience(): ?int
    {
        return $this->anne_experience;
    }

    public function setAnneExperience(int $anne_experience): static
    {
        $this->anne_experience = $anne_experience;

        return $this;
    }

    public function getDernierDiplome(): ?string
    {
        return $this->dernier_diplome;
    }

    public function setDernierDiplome(string $dernier_diplome): static
    {
        $this->dernier_diplome = $dernier_diplome;

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
     * @return Collection<int, Session>
     */
    public function getSession(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): static
    {
        $this->sessions->removeElement($session);

        return $this;
    }
}
