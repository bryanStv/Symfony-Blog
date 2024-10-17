<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{
    #[Route('/admin/images', name: 'app_images')]
    public function images(): Response
    {
        return $this->render('admin/images.html.twig', []);
    }

    #[Route('/admin/categories', name: 'app_categories')]
    public function categories(ManagerRegistry $doctrine, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_categories', []);
        }
        return $this->render('admin/categories.html.twig', array(
            'form' => $form->createView()
        ));
    }
}