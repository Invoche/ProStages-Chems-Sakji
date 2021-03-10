<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function index()
    {
      // Récupérer le repository de l'entité Stages
      $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);

      // Récupérer les stages enregistrées en BD
      $stages = $repositoryStages->findAll();


      // Envoyer les stages récupérées à la vue chargée de les afficher
      return $this->render('pro_stages/index.html.twig',['stages'=>$stages]);
    }

    /**
     * @Route("/entreprises/{nom}", name="pro_stages_entreprises")
     */
    public function listeEntreprisesParNom($nom)
    {
      // Récupérer le repository de l'entité Stages
      $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);


      // Récupérer les stages enregistrées en BD
      $stages = $repositoryStages->findByNomEntreprise($nom);

      return $this->render('pro_stages/listeEntreprises.html.twig', [ 'stages' => $stages, 'nom' => $nom]);
    }

    /**
     * @Route("/filtreEntreprises", name="pro_stages_filtre_entreprises")
     */
    public function filtreEntreprises()
    {
      $repositoryEntreprises = $this->getDoctrine()->getRepository(Entreprise::class);

      $entreprise = $repositoryEntreprises->findAll();

      return $this->render('pro_stages/filtreEntreprises.html.twig', ['entreprise'=>$entreprise]);
    }

    /**
     * @Route("/formations/{id}", name="pro_stages_formations")
     */
    public function listeFormations($id)
    {
      // Récupérer le repository de l'entité Stages
      $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);


      // Récupérer les stages enregistrées en BD
      $formation = $repositoryFormations->find($id);

      return $this->render('pro_stages/listeFormations.html.twig', ['formation' => $formation]);
    }

    /**
     * @Route("/filtreFormations", name="pro_stages_filtre_formations")
     */
    public function filtreFormations()
    {
      $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);

      $formation = $repositoryFormations->findAll();

      return $this->render('pro_stages/filtreFormations.html.twig', ['formation'=>$formation]);
    }

    /**
     * @Route("/stage/{id}", name="pro_stages_stages")
     */
    public function descriptifStage($id)
    {
      // Récupérer le repository de l'entité Stages
      $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);


      // Récupérer les stages enregistrées en BD
      $stages = $repositoryStages->find($id);


      // Envoyer les stages récupérées à la vue chargée de les afficher
      return $this->render('pro_stages/descriptifStage.html.twig',
      ['stages'=>$stages]);
    }
}
