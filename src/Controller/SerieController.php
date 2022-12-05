<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Serie;
use App\Entity\Platefrome;

class SerieController extends AbstractController
{
    #[Route('/serie')]
    public function index(): Response
    {
        return $this->render('serie/index.html.twig', [
            'controller_name' => 'SerieController',
        ]);
    }

    #[Route('/newSerie/{platefrome}/{nom}')]
    public function createPlatefrome(ManagerRegistry $doctrine, int $platefrome, string $nom): Response
    {
        $entityManager = $doctrine->getManager();
        $serie = new Serie();
        $serie->setNom($nom);
        // $platefrome = $doctrine->getRepository(Platefrome::class)->find($platefrome);
        // $entityManager->persist($platefrome);
        $serie->setPlatefrome($platefrome);
        $entityManager->persist($serie);
        $entityManager->flush();
        return new Response('Saved new serie with id '.$serie->getId());
    }
}
