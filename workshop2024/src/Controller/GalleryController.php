<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'gallery')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'GalleryController',
        ]);
    }
}