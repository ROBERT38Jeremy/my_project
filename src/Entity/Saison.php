<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $numero = null;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'saison')]
    private $serie = null;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'saison')]
    private $episode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
