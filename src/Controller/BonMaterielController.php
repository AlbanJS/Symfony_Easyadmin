<?php

namespace App\Controller;


use App\Entity\BonsMateriel;
use App\Service\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('bon_materiel')]
class BonMaterielController extends AbstractController
{
    #[Route('/', name: 'bonm.listm')]
    public function indexMateriel(ManagerRegistry $doctrine): Response
    {
        $bons = $doctrine->getRepository(BonsMateriel::class)->findAll();

        return $this->render('bon_materiel/index.html.twig', ['bon_materiel' => $bons]);

    }

    #[Route('/{id}', name: 'bonm.showm')]
    public function showMateriel(ManagerRegistry $doctrine, int $id): Response
    {

        $bon = $doctrine->getRepository(BonsMateriel::class)->find($id);
        dump($bon);
        return $this->render('bon_materiel/index.html.twig', ['bon_materiel' => $bon]);
    }


    #[Route('/pdf/{id}', name: 'bonm.showm.pdf')]
    public function generatePdfBonIdMateriel(ManagerRegistry $doctrine, int $id, PdfService $pdf): Response
    {

        $bonpdf = $doctrine->getRepository(BonsMateriel::class)->find($id);
        $html = $this->render('bon_materiel/index.html.twig', ['bon_materiel' => $bonpdf]);
        dump($bonpdf);
        $pdf->showPdfFileMateriel($html, $bonpdf);
        return new Response(200);
    }

}
