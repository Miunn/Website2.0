<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function resources(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postsRepository = $entityManager->getRepository(Post::class);
        $posts = $postsRepository->findAll();

        $newPost = new Post();
        $newPostForm = $this->createForm(PostFormType::class, $newPost, [
            'attr' => [
                'class' => 'new-post-form'
            ]
        ]);
        $newPostForm->handleRequest($request);

        if ($newPostForm->isSubmitted() && $newPostForm->isValid()) {
            $entityManager->persist($newPost);
            $entityManager->flush();
            $posts[] = $newPost;
        }

        return $this->render('pages/resources.twig', [
            'posts' => $posts,
            'newPostForm' => $newPostForm->createView(),
        ]);
    }
}