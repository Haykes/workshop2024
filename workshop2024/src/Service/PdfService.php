<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $dompdf;

    public function __construct()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $this->dompdf = new Dompdf($pdfOptions);
    }

    public function showPdf(string $html, string $filename = 'document.pdf', string $orientation = 'landscape')
    {
        // Load HTML to Dompdf
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', $orientation);

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF to Browser (inline view)
        return new Response($this->dompdf->stream($filename, [
            'Attachment' => false
        ]));
    }

    public function getPdfOutput(string $html, string $orientation = 'landscape'): string
    {
        // Load HTML to Dompdf
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', $orientation);

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF as a string
        return $this->dompdf->output();
    }
}