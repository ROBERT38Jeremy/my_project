<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'serie')]
    private ?int $episode = null;

    #[ORM\ManyToOne(targetEntity: Platefrome::class, inversedBy: 'serie')]
    private ?int $platefrome;

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

    public function getPlatefrome(): ?int
    {
        return $this->platefrome;
    }

    public function setPlatefrome(?int $platefrome): self
    {
        $this->platefrome = $platefrome;

        return $this;
    }

    public function getSaison(): ?int
    {
        return $this->saison;
    }

    public function setSaison(?int $saison): self
    {
        $this->saison = $saison;

        return $this;
    }
}
