<?php

namespace App\Entity;

use App\Repository\PlatefromeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlatefromeRepository::class)]
class Platefrome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Ton nom est trop court',
        maxMessage: 'Ton nom est trop long',
    )]
    protected ?string $nom;

    #[ORM\Column(length: 255)]
    #[Assert\Url(message: 'The url {{ value }} is not a valid url',)]
    protected ?string $url;

    #[ORM\OneToMany(targetEntity: Serie::class, mappedBy: 'platefrome')]
    private $serie;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
