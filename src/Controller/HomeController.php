<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $repo)
    {
        $allLastestProperties = $repo->findLastest();
        return $this->render('home/index.html.twig', [
            "allLastestProperties" => $allLastestProperties
        ]);
    }
}
