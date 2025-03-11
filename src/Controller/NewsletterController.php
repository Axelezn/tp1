<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Service\NewsletterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', name: 'newsletter_subscribe', methods: ['POST'])]
    public function subscribe(Request $request, EntityManagerInterface $entityManager, NewsletterService $newsletterService): Response
    {
        $newsletter = new Newsletter();
        $form = $newsletterService->createNewsletterForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletter = $form->getData();
            $newsletter->setSubscribedAt(new \DateTimeImmutable());
            $entityManager->persist($newsletter);
            $entityManager->flush();

            $this->addFlash('success', 'Votre inscription à la newsletter a été prise en compte.'); // Ajout de cette ligne

            return $this->redirectToRoute('homepage');
        }

        return $this->render('newsletter/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}