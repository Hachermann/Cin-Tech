<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    #[Route('/catalogue', name: 'app_movie_index')]

    #[Route('/catalogue{id}', name: 'app_movie_show', requirements: ['id' => '\d+'], methods: ['GET'])]

    #[Route('/api/catalogue', name: 'api_movie_list')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
}
