<?php

namespace App\Controller;

use App\Service\NewsletterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\ProductController;
use Doctrine\ORM\EntityManagerInterface;

final class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'homepage')]
    public function index(NewsletterService $newsletterService, ProductController $productController, EntityManagerInterface $entityManager): Response
    {
        $form = $newsletterService->createNewsletterForm();
        $products = $productController->getFeaturedProducts($entityManager);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'form' => $form->createView(),
            'products' => $products,
        ]);
    }
}