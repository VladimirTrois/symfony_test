<?php

namespace App\Controller;

use App\Entity\Biere;
use App\Form\BiereType;
use App\Repository\BiereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class BiereController extends AbstractController
{

    /**
     * @var BiereRepository
     */
    private $repository;

    public function __construct(BiereRepository $repository)
    {
        $this->repository = $repository;
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

            return $this->redirectToRoute('checklist');
        }

        return $this->render('biere/create.html.twig', array('form' => $form->createView()) );
    }

    /**
     * @Route("/biere/{slug}-{id}", name="biere.info", requirements={"slug":"[a-z0-9\-]*"})
     * @param Biere $biere
     * @param string $slug
     * @return Response
     */
    public function show(Biere $biere, string $slug): Response{

        if ($biere->getSlug() !== $slug){
            //bon pour le référencement
            return $this->redirectToRoute('biere.info',[
                'id' => $biere->getId(),
                'slug' => $biere->getSlug()
            ], 301);
        }
        return $this->render('biere/show.html.twig', [
            'biere' => $biere,
            'current_menu' => 'bieres'
        ]);

    }
}