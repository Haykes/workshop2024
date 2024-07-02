<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VenteController extends AbstractController
{
    #[Route('/vente', name: 'vente')]
    public function vente(): Response
    {
        return $this->render('vente/index.html.twig', [
            'controller_name' => 'VenteController',
        ]);
    }

    #[Route('/ecommerce', name: 'ecommerce')]
    public function ecommerce(): Response
    {
        return $this->render('ecommerce/index.html.twig', [
            'controller_name' => 'VenteController',
        ]);
    }
}
