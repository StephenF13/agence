<?php

namespace App\Controller;


use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
    public function index()
    {
        return $this->render('property/index.html.twig');
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