<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: 'Ton nom est trop court',
        maxMessage: 'Ton nom est trop long',
    )]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'serie')]
    private $episode = null;

    #[ORM\ManyToOne(targetEntity: Platefrome::class, inversedBy: 'serie')]
    private $platefrome;

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

    public function setPlatefrome(?Platefrome $platefrome): self
    {
        $this->platefrome = $platefrome;

        return $this;
    }

    public function __construct(string $nom, Platefrome $platefrome)
    {
        $this->setNom($nom);
        $this->setPlatefrome($platefrome);
    }
}
