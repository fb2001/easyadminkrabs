<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Notation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $prix;

    #[ORM\Column(type: 'integer')]
    private int $ambiance;

    #[ORM\Column(type: 'integer')]
    private int $qualite;

    #[ORM\Column(length: 255)]
    private string $typeNotation;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'notations')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(targetEntity: Enseigne::class, inversedBy: 'notations')]
    private ?Enseigne $enseigne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getAmbiance(): int
    {
        return $this->ambiance;
    }

    public function setAmbiance(int $ambiance): self
    {
        $this->ambiance = $ambiance;
        return $this;
    }

    public function getQualite(): int
    {
        return $this->qualite;
    }

    public function setQualite(int $qualite): self
    {
        $this->qualite = $qualite;
        return $this;
    }

    public function getTypeNotation(): string
    {
        return $this->typeNotation;
    }

    public function setTypeNotation(string $typeNotation): self
    {
        $this->typeNotation = $typeNotation;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getEnseigne(): ?Enseigne
    {
        return $this->enseigne;
    }

    public function setEnseigne(?Enseigne $enseigne): self
    {
        $this->enseigne = $enseigne;
        return $this;
    }
}