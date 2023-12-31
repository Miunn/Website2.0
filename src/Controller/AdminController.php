<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostCategory;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response {
        $categoriesRepository =  $entityManager->getRepository(PostCategory::class);
        $categories = $categoriesRepository->findAll();

        $postsRepository = $entityManager->getRepository(Post::class);
        $posts = $postsRepository->findLasts(15);

        $newPost = new Post();
        $newPostForm = $this->createForm(PostFormType::class, $newPost, [
            'attr' => [
                'class' => 'new-post-form'
            ]
        ]);
        $newPostForm->handleRequest($request);

        if ($newPostForm->isSubmitted() && $newPostForm->isValid()) {
            dump($newPostForm);
            $entityManager->persist($newPost);
            $entityManager->flush();
            $posts[] = $newPost;
        }

        return $this->render('pages/admin.twig', [
            'categories' => $categories,
            'posts' => $posts,
            'newPostForm' => $newPostForm->createView(),
        ]);
    }
}