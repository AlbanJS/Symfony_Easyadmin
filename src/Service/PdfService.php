<?php
namespace App\Service;

use App\Entity\BonsMateriel;
use App\Entity\BonsTravail;
use Dompdf\Dompdf;
use Dompdf\Options;



class PdfService
{


    private $domPdf;


    public function showPdfFileTravail($html, BonsTravail $bonsTravail): Dompdf
    {


        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $domPdf = new Dompdf($options);
        $domPdf->loadHtml($html);
        $domPdf->render();
        $domPdf->stream('Bon.' . $bonsTravail->getNumero() . '.pdf', [
            "Attachment" => true,
            'Content-Type' => 'application/pdf'
        ]);
        return $domPdf;


    }

    public function showPdfFileMateriel($html, BonsMateriel $bonsMateriel): Dompdf
    {


        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $domPdfMat = new Dompdf($options);
        $domPdfMat->loadHtml($html);
        $domPdfMat->render();
        $domPdfMat->stream('Bon_Materiel.' . $bonsMateriel->getId() . '.pdf', [
            "Attachment" => true,
            'Content-Type' => 'application/pdf'
        ]);
        return $domPdfMat;


    }

}



