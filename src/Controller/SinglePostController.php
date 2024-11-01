<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SinglePostController extends AbstractController
{
    /*#[Route('/single_post/{slug}', name: 'single_post')]
    public function post(ManagerRegistry $doctrine, $slug): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $post = $repository->findOneBy(["slug"=>$slug]);
        $recents = $repository->findRecents();
        return $this->render('blog/single_post.html.twig', [
            'post' => $post,
            'recents' => $recents
        ]);
    }*/
    #[Route('/single_post/{slug}', name: 'app_single_post')]
    public function post(PostRepository $postRepository, $slug): Response
    {
        $post = $postRepository->findOneBy(["slug" => $slug]);
        $recents = $postRepository->findRecents();

        return $this->render('blog/single_post.html.twig', [
            'post' => $post,
            'recents' => $recents
        ]);
    }
}
