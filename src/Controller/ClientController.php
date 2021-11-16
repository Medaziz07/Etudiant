<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client')]
    public function index(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $client = $em->getRepository("App\Entity\Client")->findAll();
        return $this->render('client/Client.html.twig', [
            'client' => $client,
        ]);
    }
}
