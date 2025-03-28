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

    #[ORM\OneToMany(targetEntity: Notation::class, mappedBy: 'user')]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Enseigne::class, mappedBy: 'favoris')]
    private Collection $enseignesFavorites;

    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->enseignesFavorites = new ArrayCollection();
    }
}
