<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud')]
class CrudController extends AbstractController
{
    #[Route('/', name: 'crud_index', methods: ['GET'])]
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('crud/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_show', methods: ['GET'])]
    public function show(Voiture $voiture): Response
    {
        return $this->render('crud/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voiture $voiture): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_delete', methods: ['POST'])]
    public function delete(Request $request, Voiture $voiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
