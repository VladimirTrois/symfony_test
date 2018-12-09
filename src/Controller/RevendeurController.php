<?php

namespace App\Controller;

use App\Entity\Brasserie;
use App\Form\BrasserieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BrasserieController extends AbstractController
{

    /**
     * @Route( "/brasserie/info", name="brasserie")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('brasserie/info.html.twig');

    }

    /**
     * @Route("/brasserie/create", name="brasserie.create")
     */
    public function new(Request $request){

        $brasserie= new brasserie();
        $form = $this->createForm(BrasserieType::class, $brasserie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brasserie);
            $entityManager->flush();

            return $this->redirectToRoute('checklist');
        }

        return $this->render('brasserie/create.html.twig', array('form' => $form->createView()) );
    }
}