<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPlanetsActionController extends AbstractController
{
    #[Route('/get/planets/action', name: 'app_get_planets_action')]
    public function index(): Response
    {
        return $this->render('get_planets_action/index.html.twig', [
            'controller_name' => 'GetPlanetsActionController',
        ]);
    }
}
