<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column(length: 255, unique: true)]
    private string $email;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(length: 255)]
    private string $prenom;

    #[ORM\Column(type: 'integer')]
    private int $age;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroTelephone;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseMail;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoProfil;

    #[ORM\OneToMany(targetEntity: Notation::class, mappedBy: 'utilisateur')]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Enseigne::class, mappedBy: 'favoris')]
    private Collection $enseignesFavorites;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'utilisateurs')]
    private Collection $categories;

    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->enseignesFavorites = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(?string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;
        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(?string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;
        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): self
    {
        $this->photoProfil = $photoProfil;
        return $this;
    }

    /**
     * @return Collection|Notation[]
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): self
    {
        if (!$this->notations->contains($notation)) {
            $this->notations->add($notation);
            $notation->setUtilisateur($this);
        }
        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->removeElement($notation)) {
            if ($notation->getUtilisateur() === $this) {
                $notation->setUtilisateur(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Enseigne[]
     */
    public function getEnseignesFavorites(): Collection
    {
        return $this->enseignesFavorites;
    }

    public function addEnseignesFavorite(Enseigne $enseigne): self
    {
        if (!$this->enseignesFavorites->contains($enseigne)) {
            $this->enseignesFavorites->add($enseigne);
            $enseigne->addFavori($this);
        }
        return $this;
    }

    public function removeEnseignesFavorite(Enseigne $enseigne): self
    {
        if ($this->enseignesFavorites->removeElement($enseigne)) {
            $enseigne->removeFavori($this);
        }
        return $this;
    }
    
    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $categorie): self
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories->add($categorie);
            $categorie->addUtilisateur($this);
        }
        return $this;
    }

    public function removeCategory(Categorie $categorie): self
    {
        if ($this->categories->removeElement($categorie)) {
            $categorie->removeUtilisateur($this);
        }
        return $this;
    }
}