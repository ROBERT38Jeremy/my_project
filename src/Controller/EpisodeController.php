<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Episode;
use App\Entity\Saison;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class EpisodeController extends AbstractController
{
    #[Route('/episode')]
    public function index(): Response
    {
        return $this->render('episode/index.html.twig', [
            'controller_name' => 'EpisodeController',
        ]);
    }

    #[Route('/newEpisode/{nom}')]
    public function createEpisode(string $nom, int $numero, int $note, Saison $saison, ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $episode = new Episode($nom, $numero, $note, $saison);
        $errors = $validator->validate($episode);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }
        $entityManager->persist($episode);
        $entityManager->flush();
        return new Response('Saved new episode with id '.$episode->getId());
    }
}
