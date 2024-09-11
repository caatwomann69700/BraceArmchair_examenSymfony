<?php
// src/Controller/SplashController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SplashController extends AbstractController
{
    /**
     * @Route("/splash", name="splash_screen")
     */
    public function index()
    {
        return $this->render('splash_screen.html.twig');
    }
}
