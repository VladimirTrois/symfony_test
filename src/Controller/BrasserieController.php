<?php

namespace App\Controller;

use App\Entity\Biere;
use App\Form\BiereType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BiereController extends AbstractController
{

    /**
     * @Route( "/biere/info", name="biere")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('biere/info.html.twig');

    }

    /**
     * @Route("/biere/create", name="biere.create")
     */
    public function new(Request $request){

        $biere= new biere();
        $form = $this->createForm(BiereType::class, $biere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($biere);
            $entityManager->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('biere/create.html.twig', array('form' => $form->createView()) );
    }
}