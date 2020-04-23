<?php

namespace App\Controller;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{

    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *@Route("/admin", name="admin.property.index")
     */
   public function index()
   {
        $properties = $this->repository->findAll();
        return $this->render("admin/index.html.twig", [
            "properties" => $properties
        ]);
   }

   /**
    * Undocumented function
    *@Route("/admin/bien/create", name="admin.property.create")
    */
   public function new(Request $request, EntityManagerInterface $manager)
   {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($property);
            $manager->flush();
            $this->addFlash('success', 'Le bien a bien été crée.');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/new.html.twig", [
            "form" => $form->createView()
        ]);
   }

   /**
    * @Route("/admin/{id}", name="admin.property.edit", methods={"GET|POST"})
    */
    public function edit($id, Request $request, EntityManagerInterface $manager)
    {
        $property = $this->repository->find($id);

        // $option = new Option();
        // $property->addOption($option);


        $form = $this-> createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->flush();
            $this->addFlash('success', 'Le bien a bien été mis à jour.');
            return $this->redirectToRoute('admin.property.index');
        }
        
        return $this->render("admin/edit.html.twig", [
            "property" => $property,
            "form" => $form->createView()
        ]);
    }

    /**
     *@Route("admin/{id}", name="admin.property.delete", methods={"DELETE"})
     */
    public function delete($id, EntityManagerInterface $manager)
    {
        $property = $this->repository->find($id);
        $manager->remove($property);
        $manager->flush();
        $this->addFlash('success', 'Le bien a bien été supprimé.');
        return $this->redirectToRoute('admin.property.index');
    }
}
