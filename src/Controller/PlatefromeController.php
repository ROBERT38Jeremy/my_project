<?php
namespace App\Controller;

// ...
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Platefrome;

class PlatefromeController extends AbstractController
{
    #[Route('/newPlatefrome/{nom}', name: 'platefrome_insert')]
    public function createPlatefrome(ManagerRegistry $doctrine, string $nom): Response
    {
        $entityManager = $doctrine->getManager();
        $platefrome = new Platefrome($nom);
        $entityManager->persist($platefrome);
        $entityManager->flush();
        return new Response('Saved new platefrome with id '.$platefrome->getId());
    }

    #[Route('/getPlatefromes', name: 'platefrome_show')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $platefromes = $doctrine->getRepository(Platefrome::class)->findAll();
        if (!$platefromes) {
            throw $this->createNotFoundException(
                'No platefrome found'
            );
        }

        $return = '';
        foreach ($platefromes as $platefrome) {
            $return .= 'Check out this great platefrome: '.$platefrome->getNom().'<br>';
        }
        return new Response(
           $return
            );
    }
}