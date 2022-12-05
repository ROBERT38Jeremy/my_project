<?php
namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

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
    private int $numero;

    #[ORM\Column]
    private int $note;
}