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
    public function createSerie(ManagerRegistry $doctrine, int $platefrome, string $nom, ValidatorInterface $validator): Response
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

    #[Route('/Procedure/newSerie/{platefrome}/{nom}')]
    public function createProcedureSerie(ManagerRegistry $doctrine, int $platefrome, string $nom, ValidatorInterface $validator): Response
    {
        $conn = $doctrine->getConnection();

        $sql = "CALL insert_serie(:nom, :plateform)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('nom', $nom);
        $stmt->bindValue('plateform', $platefrome);
        $resultSet = $stmt->executeQuery();

        return $this->redirect('/getSerie');
    }

    #[Route('/getSerie')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $series = $doctrine->getRepository(Serie::class)->findAll();
        if (!$series) {
            throw $this->createNotFoundException(
                'No platefrome found'
            );
        }

        $return = '';
        foreach ($series as $serie) {
            $return .= 'Check out this great platefrome: '.$serie->getNom().'<br>';
        }
        return new Response($return);
    }

    #[Route('/CSV/serie')]
    public function createSerieFromCsv(ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $csv_stream = fopen('C:\wamp64\www\projet_cours_cesi\my_project\public\series.csv', 'r');
        $response = '';
        $array_series = [];
        $datas = [];
        while($ligne = fgetcsv($csv_stream)) {
            $datas[] = [
                'name' => $ligne[0],
                'platefrome_name' => $ligne[1],
                'platefrome_url' => $ligne[2],
                'nb_saison' => $ligne[3]
            ];
        }
        fclose($csv_stream);
        $array_series = array_unique($datas, SORT_REGULAR);

        foreach($array_series as $serie_name => $data) {
            $response .= $serie_name.' => '.implode(', ', $data).'<br>';
        }
        return new Response($response);

        // $entityManager = $doctrine->getManager();

        // $platefrome = new Platefrome();
        // $serie = new Serie($nom, $platefrome);
        // $platefrom = $doctrine->getRepository(Platefrome::class)->find($platefrome);
        // $serie->setPlatefrome($platefrom);
        // $errors = $validator->validate($serie);
        // if (count($errors) > 0) {
        //     $errorsString = (string) $errors;
        //     return new Response($errorsString);
        // }
        // $entityManager->persist($serie);
        // $entityManager->flush();
        // return new Response('Saved new serie with id '.$serie->getId());
    }
}
