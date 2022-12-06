<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Saison;
use App\Entity\Episode;
use App\Entity\Serie;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class SaisonController extends AbstractController
{
    #[Route('/saison')]
    public function index(): Response
    {
        return $this->render('saison/index.html.twig', [
            'controller_name' => 'SaisonController',
        ]);
    }

    #[Route('/newSaison/{num}/{serie_id}')]
    public function createSaison(int $num, int $serie_id, ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $saison = new Saison();
        $saison->setNumero($num);
        $serie = $doctrine->getRepository(Serie::class)->find($serie_id);
        $saison->setSerie($serie);
        $errors = $validator->validate($saison);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }

        $episodes = [
            [
                'nom' => 'episode premier',
                'note' => 5
            ],
            [
                'nom' => 'episode deuxième',
                'note' => 5
            ],
            [
                'nom' => 'episode troisième',
                'note' => 2
            ]
        ];
        $errors = [];

        $doctrine->getConnection()->beginTransaction();
        $entityManager->persist($saison);

        for($i = 0; $i < count($episodes); $i++) {
            try {
                $episode = new Episode($episodes[$i]['nom'], $i, $episodes[$i]['note'], $saison);
                $entityManager->persist($episode);
            } catch (\Throwable $th) {
                $errors[] = $th->getMessage();
                throw $th;
            }
        }

        if (empty($errors)) {
            $entityManager->flush();
            $doctrine->getConnection()->commit();
            return new Response('Saved new episode with saison_id '.$saison->getId());
        } else {
            $doctrine->getConnection()->rollBack();
            return new Response('Transaction failed');
        }
    }
}
