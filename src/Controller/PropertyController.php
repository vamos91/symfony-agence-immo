<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use App\Notification\ContactNotification;
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
     * @Route("/biens/{slug}-{id}", name="show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show($slug, $id, Request $request, ContactNotification $contactNotification)
    {
        $property = $this->repo->find($id);

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
            $contactNotification->notify($contact);
            $this->addFlash('success', 'Votre mail a bien été envoyé');
            return $this->redirectToRoute('show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }
        $property = $this->repo->find($id);
        return $this->render("property/show.html.twig", [
            "menu" => "properties",
            "property" => $property,
            "form" => $form->createView()
        ]);    
    }
}
