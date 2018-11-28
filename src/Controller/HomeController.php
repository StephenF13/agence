<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Property;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController
{
    public function index()
    {
        $properties = $this->getDoctrine()->getRepository(Property::class)->findLatest();

        return $this->render('pages/home.html.twig', ['properties' => $properties]);
    }
}