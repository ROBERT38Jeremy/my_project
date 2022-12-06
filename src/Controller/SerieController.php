<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Serie;
use App\Entity\Platefrome;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function createPlatefrome(ManagerRegistry $doctrine, int $platefrome, string $nom, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $serie = new Serie();
        $serie->setNom($nom);
        $platefrom = $doctrine->getRepository(Platefrome::class)->find($platefrome);
        $serie->setPlatefrome($platefrom);
        $errors = $validator->validate($serie);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }
        $entityManager->persist($serie);
        $entityManager->flush();
        return new Response('Saved new serie with id '.$serie->getId());
    }
}
