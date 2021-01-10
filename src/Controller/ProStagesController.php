<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function index(): Response
    {
        return $this->render('pro_stages/index.html.twig');
    }

    /**
     * @Route("/entreprises/{id}", name="pro_stages_entreprises")
     */
    public function listeEntreprises($id): Response
    {
        return $this->render('pro_stages/listeEntreprises.html.twig',
        [ 'id' => $id]);
    }

    /**
     * @Route("/filtreEntreprises", name="pro_stages_filtre_entreprises")
     */
    public function filtreEntreprises(): Response
    {
        return $this->render('pro_stages/filtreEntreprises.html.twig');
    }

    /**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function listeFormations(): Response
    {
        return $this->render('pro_stages/listeFormations.html.twig');
    }

    /**
     * @Route("/filtreFormations", name="pro_stages_filtre_formations")
     */
    public function filtreFormations(): Response
    {
        return $this->render('pro_stages/filtreFormations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="pro_stages_stages")
     */
    public function descriptifStage($id): Response
    {
        return $this->render('pro_stages/descriptifStage.html.twig',
      [ 'id' => $id]);
    }
}
