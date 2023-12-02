<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
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
    public function resources(EntityManagerInterface $entityManager): Response
    {
        $postsRepository = $entityManager->getRepository(Post::class);
        $posts = $postsRepository->findAll();
        return $this->render('pages/resources.twig', [
            'posts' => $posts,
        ]);
    }
}