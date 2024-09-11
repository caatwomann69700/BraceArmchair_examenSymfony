<?php 
// src/Controller/SubscriberController.php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SubscriberController extends AbstractController
{
    #[Route('/newsletter', name: 'newsletter_subscribe')]
    public function subscribe(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $newsletter = new Newsletter();
        
        $form = $this->createForm(NewsletterType::class, $newsletter);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Définir automatiquement la date d'inscription
            $newsletter->setSubscribedAt(new \DateTimeImmutable());
            
            // Sauvegarder les données dans la base de données
            $entityManager->persist($newsletter);
            $entityManager->flush();

            // Envoyer un email de remerciement
            $email = (new Email())
                ->from('bracearmchair@gmail.com')  // Remplace par ton email
                ->to($newsletter->getEmail())    // Adresse email de l'utilisateur
                ->subject('Thank you for subscribing to our newsletter')
                ->html(
                    '<h1>Welcome to our Newsletter!</h1>' .
                    '<p>Thank you for signing up. We are thrilled to have you with us.</p>' .
                    '<p>You will soon receive news and exclusive offers.</p>' .
                    '<p>See you soon,</p>' .
                    '<p><strong>The BRACE ARMCHAIR Team</strong></p>');
            $mailer->send($email);

            // Ajouter un message de succès en anglais
            $this->addFlash('success', 'Thank you for subscribing to our newsletter! A confirmation email has been sent to you.');

            return $this->redirectToRoute('newsletter_subscribe');
        }

        return $this->render('subscriber/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
