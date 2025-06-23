<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListeDesGlacesController extends AbstractController
{
    #[Route('/liste/des/glaces', name: 'app_liste_des_glaces')]
    public function index(): Response
    {
        return $this->render('liste_des_glaces/index.html.twig', [
            'controller_name' => 'ListeDesGlacesController',
        ]);
    }
}
