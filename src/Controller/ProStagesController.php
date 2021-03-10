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
     * @Route("/ajouterEntreprise", name="pro_stages_ajoutEntreprise")
     */
    public function ajouterEntreprise()
    {
      //Création d'une ressource vierge qui sera remplie par le formulaire
      $entreprise = new Entreprise();

      // Création du formulaire permettant de saisir une ressource
      $formulaireEntreprise = $this->createFormBuilder($entreprise)
      ->add('idEntreprise')
      ->add('nom')
      ->add('adresse')
      ->add('activite')
      ->getForm();

      // Afficher la page présentant le formulaire d'ajout d'une ressource
      return $this->render('pro_stages/ajoutEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView()]);
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
     * @Route("/formations/{intitule}", name="pro_stages_formations")
     */
    public function listeFormations($intitule)
    {
      // Récupérer le repository de l'entité Stages
      $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);


      // Récupérer les stages enregistrées en BD
      $stages = $repositoryStages->findByNomFormation($intitule);

      return $this->render('pro_stages/listeFormations.html.twig', ['stages' => $stages, 'intitule'=> $intitule]);
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
