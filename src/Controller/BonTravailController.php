<?php

namespace App\Controller;


use App\Entity\BonsTravail;
use App\Service\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('bon')]
class BonTravailController extends AbstractController
{
    #[Route('/', name: 'bon.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $bons = $doctrine->getRepository(BonsTravail::class)->findAll();

        return $this->render('bon/Bon_travail_pdf.html.twig', ['bon' => $bons]);

    }

    #[Route('/{id}', name: 'bon.show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {

        $bon = $doctrine->getRepository(BonsTravail::class)->find($id);
        dump($bon);
        return $this->render('bon/Bon_travail_pdf.html.twig', ['bon' => $bon]);
    }


    #[Route('/pdf/{id}', name: 'bon.show.pdf')]
    public function generatePdfBonId(ManagerRegistry $doctrine, int $id, PdfService $pdf): Response
    {

        $bonpdf = $doctrine->getRepository(BonsTravail::class)->find($id);
        $html = $this->render('bon/Bon_travail_pdf.html.twig', ['bon' => $bonpdf]);
        dump($bonpdf);
        $pdf->showPdfFileTravail($html, $bonpdf);
        return new Response(200);
    }

}






