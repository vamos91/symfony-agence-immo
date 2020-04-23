<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(PaginatorInterface $paginator, Request $request)
    {
        //gérer tout ca dans le controller
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $query = $this->repo->findAllVisibleQuery($search);
        $properties = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('property/index.html.twig', [
            "menu" => "properties",
            "properties" => $properties,
            "form" => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/biens/{slug}-{id}", name="show", methods={"GET"}, requirements={"slug": "[a-z0-9\-]*"})
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
