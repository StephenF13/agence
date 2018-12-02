<?php

namespace App\Controller;


use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $properties = $paginator->paginate($em->getRepository(Property::class)->findAllVisibleQuery($search),
            $request->query->getInt('page', 1) /*page number*/,
            12 /*limit per page*/);

        return $this->render('property/index.html.twig', ['properties' => $properties, 'form' => $form->createView()]);
    }

    public function show($slug, $id)
    {
        $property = $this->getDoctrine()->getRepository(Property::class)->find($id);

        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', ['id' => $property->getId(), 'slug' => $property->getSlug()],
                301);
        }

        return $this->render('property/show.html.twig', ['property' => $property]);
    }
}