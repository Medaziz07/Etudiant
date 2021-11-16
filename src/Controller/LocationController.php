<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'location')]
    public function listelocation(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $location=$em->getRepository("App\Entity\Location")->findAll();
        return $this->render('location/Location.html.twig', [
            "Location"=>$location
        ]);
    }
}
