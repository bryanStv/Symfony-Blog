<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageListController extends AbstractController
{
    #[Route('/image/list', name: 'app_image_list')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        /*$imagesDirectory = $this->getParameter('kernel.project_dir') . '/public/images/index/gallery/';

        // Escanear el directorio para obtener los archivos
        $files = scandir($imagesDirectory);*/

        $repositorio = $doctrine->getRepository(Image::class);

        $images = $repositorio->findAll();

        return $this->render('image_list/index.html.twig', [
            'images' => $images,
        ]);
    }
}
