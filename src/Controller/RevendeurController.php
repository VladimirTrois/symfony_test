<?php

namespace App\Controller;

use App\Entity\Revendeur;
use App\Form\RevendeurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RevendeurController extends AbstractController
{

    /**
     * @Route( "/revendeur/show", name="revendeur")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('revendeur/show.html.twig');

    }

    /**
     * @Route("/revendeur/create", name="revendeur.create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request){

        $revendeur= new revendeur();
        $form = $this->createForm(RevendeurType::class, $revendeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($revendeur);
            $entityManager->flush();

            return $this->redirectToRoute('checklist');
        }

        return $this->render('revendeur/create.html.twig', array('form' => $form->createView()) );
    }
}