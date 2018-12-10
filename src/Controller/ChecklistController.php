<?php

namespace App\Controller;

use App\Entity\Biere;
use App\Entity\BiereSearch;
use App\Entity\Checklist;
use App\Form\ChecklistType;
use App\Repository\BiereRepository;
use App\Form\BiereSearchType;
use App\Repository\ChecklistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChecklistController extends AbstractController
{
    /**
     * @var ChecklistRepository
     */
    private $checklistRepository;

    public function __construct(ChecklistRepository $checklistRepository)
    {
        $this->checklistRepository = $checklistRepository;
    }

    /**
     * @Route("checklist", name="checklist")
     * @param BiereRepository $repository
     * @param Request $request
     * @return Response
     */
    public function index(BiereRepository $biereRepository, Request $request): Response
    {
        $search = new BiereSearch();
        $form = $this->createForm(BiereSearchType::class, $search);
        $form->handleRequest($request);
        $bieres=$biereRepository->listBiereLikeNomBiereOuBrasserie($search);
        $nbBiere = $this->checklistRepository->nbBiere($this->getUser());
        $nbBiereDistinct=$this->checklistRepository->nbBiereDistinct($this->getUser());

        return $this->render(
            'checklist/show.html.twig',[
            'bieres' => $bieres,
            'nbBiere' => $nbBiere,
            'nbBiereDistinct' => $nbBiereDistinct,
            'form' => $form->createView()
        ]
        );
    }

    /**
     * @Route("checklist/ajoutBiere/{slug}-{id}", name="ajoutBiere", requirements={"slug":"[a-z0-9\-]*"})
     * @param Request $request
     * @param Biere $biere
     * @return Response
     */
    public function new(Request $request, Biere $biere) :Response
    {
        $checklist = new Checklist();
        $checklist->setUser($this->getUser());
        $checklist->setBiere($biere);
        $form = $this->createForm(ChecklistType::class, $checklist);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($checklist);
            $entityManager->flush();

            return $this->redirectToRoute('checklist');
        }
        return $this->render('checklist/ajoutBiere.html.twig', [
            'biere' => $biere,
            'form' => $form->createView()
        ] );
    }

    /**
     * @Route("stats", name="stats")
     * @return Response
     */
    public function statistique() :Response
    {
        $nbBiere=$this->checklistRepository->nbBiere($this->getUser());
        $nbBiereDistinct=$this->checklistRepository->nbBiereDistinct($this->getUser());
        dump($nbBiereDistinct);
        $nbBiereDistinctType=$this->checklistRepository->nbBiereDistinctType($this->getUser());
        dump($nbBiereDistinctType);
        $nbBiereDistinctOrigineBrasseur=$this->checklistRepository->nbBiereDistinctOrigineBrasseur($this->getUser());
        dump($nbBiereDistinctOrigineBrasseur);
        $biereFavorites=$this->checklistRepository->biereFavorites($this->getUser());
        dump($biereFavorites);

        return $this->render(
            'checklist/statistique.html.twig',[
                'nbBiere' => $nbBiere,
                'nbBiereDistinct' => $nbBiereDistinct,
                'nbBiereDistinctType'=> $nbBiereDistinctType,
                'nbBiereDistinctOrigineBrasseur' => $nbBiereDistinctOrigineBrasseur,
                'biereFavorites' => $biereFavorites
            ]
        );
    }
}
