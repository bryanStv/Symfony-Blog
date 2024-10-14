<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    /*#[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }*/

    #[Route('/contact', name: 'app_contact')]
    public function contact(ManagerRegistry $doctrine, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contacto);
            $entityManager->flush();
            return $this->redirectToRoute('app_page', []);
        }
        return $this->render('contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
