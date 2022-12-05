<?php
namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;

 #[ORM\Entity(repositoryClass: ProductRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column]
    #[Assert\MoreThan(0)]
    private int $numero;

    #[ORM\Column]
    #[Assert\MoreThan(0)]
    private int $note;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'episode_id')]
    private $serie_id;
}