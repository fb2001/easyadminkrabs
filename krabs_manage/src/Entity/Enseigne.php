<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Enseigne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column(length: 255)]
    private string $numeroTelephone;

    #[ORM\Column(length: 255)]
    private string $adresse;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $noteSeuil;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $pointsCle;

    #[ORM\Column(length: 255)]
    private string $gpsLocation;

    #[ORM\OneToMany(targetEntity: Horaire::class, mappedBy: 'enseigne')]
    private Collection $horaires;

    #[ORM\OneToMany(targetEntity: Notation::class, mappedBy: 'enseigne')]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'enseignes')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'enseignesFavorites')]
    private Collection $favoris;

    public function __construct()
    {
        $this->horaires = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->favoris = new ArrayCollection();
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

    public function getNumeroTelephone(): string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;
        return $this;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getNoteSeuil(): float
    {
        return $this->noteSeuil;
    }

    public function setNoteSeuil(float $noteSeuil): self
    {
        $this->noteSeuil = $noteSeuil;
        return $this;
    }

    public function getPointsCle(): ?array
    {
        return $this->pointsCle;
    }

    public function setPointsCle(?array $pointsCle): self
    {
        $this->pointsCle = $pointsCle;
        return $this;
    }

    public function getGpsLocation(): string
    {
        return $this->gpsLocation;
    }

    public function setGpsLocation(string $gpsLocation): self
    {
        $this->gpsLocation = $gpsLocation;
        return $this;
    }

    /**
     * @return Collection|Horaire[]
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(Horaire $horaire): self
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires->add($horaire);
            $horaire->setEnseigne($this);
        }
        return $this;
    }

    public function removeHoraire(Horaire $horaire): self
    {
        if ($this->horaires->removeElement($horaire)) {
            if ($horaire->getEnseigne() === $this) {
                $horaire->setEnseigne(null);
            }
        }
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
            $notation->setEnseigne($this);
        }
        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->removeElement($notation)) {
            if ($notation->getEnseigne() === $this) {
                $notation->setEnseigne(null);
            }
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
            $categorie->addEnseigne($this);
        }
        return $this;
    }

    public function removeCategory(Categorie $categorie): self
    {
        if ($this->categories->removeElement($categorie)) {
            $categorie->removeEnseigne($this);
        }
        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Utilisateur $utilisateur): self
    {
        if (!$this->favoris->contains($utilisateur)) {
            $this->favoris->add($utilisateur);
        }
        return $this;
    }

    public function removeFavori(Utilisateur $utilisateur): self
    {
        $this->favoris->removeElement($utilisateur);
        return $this;
    }
}