<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class BlogController extends AbstractController
{
    /*#[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }*/

    #[Route('/blog', name: 'app_blog')]
    public function index(PostRepository $postRepository,ManagerRegistry $doctrine, int $page = 1): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll($page);
        $recents = $postRepository->findRecents();

        return $this->render('blog.html.twig', [
            'posts' => $posts,
            'recents' => $recents
        ]);
    }

    /*#[Route('/blog/{page}', name: 'blog', requirements: ['page' => '\d+'])]
    public function index2(ManagerRegistry $doctrine, int $page = 1): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll($page);

        return $this->render('single_post.html.twig', [
            'posts' => $posts,
        ]);
    }*/
}
