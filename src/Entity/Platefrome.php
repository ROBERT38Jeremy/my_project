<?php

namespace App\Entity;

use App\Repository\PlatefromeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatefromeRepository::class)]
class Platefrome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom;

    // #[ORM\OneToMany(targetEntity: Serie::class, mappedBy: 'platefrome')]
    // private ?int $serie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function __construct(string $name)
    {
        $this->nom = $name;
    }
}
