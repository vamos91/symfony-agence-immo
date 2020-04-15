<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    private $repo;

    public function __construct(PropertyRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/property", name="property")
     */
    public function index()
    {
        return $this->render('property/index.html.twig', [
            "menu" => "properties"
        ]);
    }

    /**
     *
     * @Route("/biens/{slug}-{id}", name="show", methods={"GET"}, requirements={"slug": "[a-z0-9\ - ]*"})
     */
    public function show($slug, $id)
    {
        $property = $this->repo->find($id);
        // $property = $this->repo->find($id);
        return $this->render("property/show.html.twig", [
            "menu" => "properties",
            "property" => $property
        ]);
        
    }
}
