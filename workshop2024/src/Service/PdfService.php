<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $dompdf;

    public function __construct()
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $this->dompdf = new Dompdf($pdfOptions);
    }

    public function savePdf(string $html, string $filename = 'document.pdf', string $orientation = 'landscape'): string
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', $orientation);
        $this->dompdf->render();
        
        $output = $this->dompdf->output();
        $filePath = 'certificats/' . $filename;
        
        file_put_contents($filePath, $output);
        
        return $filePath;
    }

    public function getPdfOutput(string $html, string $orientation = 'landscape'): string
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', $orientation);
        $this->dompdf->render();
        return $this->dompdf->output();
    }
}