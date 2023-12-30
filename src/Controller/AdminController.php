<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin_index')]
    public function index(EntityManagerInterface $entityManager): Response {
        $categoriesRepository =  $entityManager->getRepository(PostCategory::class);
        $categories = $categoriesRepository->findAll();

        $postsRepository = $entityManager->getRepository(Post::class);
        $posts = $postsRepository->findLasts(15);

        return $this->render('pages/admin.twig', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }
}