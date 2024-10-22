<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SinglePostController extends AbstractController
{
    #[Route('/singlePost/{slug}', name: 'app_single_post')]
    public function post(ManagerRegistry $doctrine, $slug): Response
    {
        $repositorio = $doctrine->getRepository(Post::class);
        $post = $repositorio->findOneBy(["slug"=>$slug]);
        return $this->render('single_post.html.twig', [
            'post' => $post,
        ]);
    }
}
