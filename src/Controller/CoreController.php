<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends AbstractController
{
    #[Route('/', name: 'app_core_index')]
    public function index(): Response
    {
        return $this->render('pages/home.twig');
    }

    #[Route('/resources', name: 'app_core_resources')]
    public function resources(): Response
    {
        $posts = [];
        return $this->render('pages/resources.twig', [
            'posts' => $posts,
        ]);
    }
}