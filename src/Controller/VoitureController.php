<?php

namespace App\Controller;

use App\App\Voitureform;
use App\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'voiture')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $voitures = $em->getRepository("App\Entity\Voiture")->findAll();

        return $this->render('voiture/listVoiture.html.twig', [
            "listeVoiture"=>$voitures
        ]);
    }

    /**
     * @Route("/addVoiture", name="add_voiture")
     */
    public function  addVoiture(Request $request): Response
    {
        $voiture = new Voiture();
        $form =$this->createForm(Voitureform::class, $voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('voiture');
        }
        return $this-> render('voiture/addVoiture.html.twig',[
            'formVoiture'=>$form->createView()
        ]);
    }

    /**
     * @Route("/deleteVoiture/{id}", name="voitureDelete")
     */
    public function deeteVoiture($id):Response{
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository("App\Entity\Voiture")->find($id);
        if($voiture!== null){
            $em->remove($voiture);
            $em->flush();
        }
        else{
            throw  new NotFoundHttpException("la voiture d'id".$id."n'existe pas");
        }
        return $this->redirectToRoute('voiture');
    }

    /**
     * @Route("/updateVoiture/{id}", name="voitureUpdate")
     */

    public function updateVoiture(Request $request, $id):Response{
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository("App\Entity\Voiture")->find($id);

        $editform = $this->createForm(VoitureForm::class, $voiture);
        $editform ->handleRequest($request);

        if($editform->isSubmitted() and $editform ->isValid()){
            $em->persist($voiture);
            $em->flush();

            return $this -> redirectToRoute('voiture');
        }
        return $this->render('voiture/updateVoiture.html.twig',['editFormVoiture'=>$editform->createView()]);
    }
}
