<?php

namespace App\Controller\Admin;

use App\Service\PdfService;
use App\Entity\Peinture;
use App\Entity\Certificat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeinturePdfController extends AbstractController
{
    private $entityManager;
    private $pdfService;

    public function __construct(EntityManagerInterface $entityManager, PdfService $pdfService)
    {
        $this->entityManager = $entityManager;
        $this->pdfService = $pdfService;
    }

    #[Route('/admin/peinture/{id}/generate-pdf', name: 'generate_pdf')]
    public function generatePdf(int $id): Response
    {
        $peinture = $this->entityManager->getRepository(Peinture::class)->find($id);

        if (!$peinture) {
            throw $this->createNotFoundException('The artwork does not exist');
        }

        // Generate the HTML for the PDF
        $html = $this->renderView('certificat_pdf.html.twig', [
            'peinture' => $peinture,
        ]);

        // Generate the PDF and save it to a file
        $filename = sprintf('certificat_%d.pdf', $peinture->getId());
        $filePath = $this->pdfService->savePdf($html, $filename, 'landscape');

        // Save the certificate information in the database
        $certificat = new Certificat();
        $certificat->setPeinture($peinture);
        $certificat->setFilePath($filePath);
        $this->entityManager->persist($certificat);
        $this->entityManager->flush();

        // Redirect to the list or detail view
        return $this->redirectToRoute('admin_dashboard');
    }
}