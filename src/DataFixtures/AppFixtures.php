<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;


class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    // Création d'un générateur de données
    $faker = \Faker\Factory::create('fr_FR');

    // CREATION DES DONNEES FORMATION
    $tabNiveau = array (
      "Dut Info"=>"BAC+2",
      "Dut GIM"=>"BAC+2",
      "Licence Pro du numérique"=>"BAC+3",
      "Licence Pro genie industriel"=>"BAC+3"
    );

    $tabFormation=array();
    $i=0;
    foreach ($tabNiveau as $codeIntitule => $titreNiveau){
      $formation = new Formation();
      $formation->setIdFormation($i);
      $formation->setIntitule($codeIntitule);
      $formation->setNiveau($titreNiveau);
      $formation->setVille($faker->city);
      $tabFormation[]=$formation;

      $manager->persist($formation);
      $i++;
    }

    // CREATION DES DONNEES ENTREPRISE
    $activitesEntreprise = array(
      "Bancaire",
      "Web",
      "Base de Donnee",
      "Industrielle",
      "Commerciale"
    );

    $tabEntreprise = array();
    for ($i=0; $i <= 7 ; $i++) {
      $entreprise = new Entreprise();
      $entreprise->setIdEntreprise($i);
      $entreprise->setNom($faker->company);
      $entreprise->setAdresse($faker->address);
      $entreprise->setActivite($faker->randomElement($activitesEntreprise));
      $manager->persist($entreprise);
      $tabEntreprise[]=$entreprise;
    }

    // CREATION DES DONNEES STAGES
    $differentesDuree = array(
      "6 semaines",
      "7 semaines",
      "8 semaines",
      "9 semaines",
    );

    $differentesCompetences = array(
      "PHP",
      "C++",
      "UML",
      "SQL",
      "javascripts"
    );

    $differentesExperiences = array(
      "1 mois",
      "2 mois",
      "3 mois",
      "6 mois"
    );

    for ($numStage=0; $numStage <= 12; $numStage++) {
      $stage = new Stage();
      $stage->setIdStage($numStage);
      $stage->setIntitule($faker->realText($maxNbChars = 40, $indexSize = 2));
      $stage->setDateDebut($faker->date);
      $stage->setDuree($faker->randomElement($differentesDuree));
      $stage->setCompetence($faker->randomElement($differentesCompetences));
      $stage->setExperience($faker->randomElement($differentesExperiences));

      $numEntreprise = $faker->numberBetween($min = 0, $max = 6);
      $stage->setEntreprise($tabEntreprise[$numEntreprise]);
      $tabEntreprise[$numEntreprise]->addStage($stage);

      $numFormation = $faker->numberBetween($min = 0, $max = 3);
      $stage->setFormation($tabFormation[$numFormation]);
      $tabFormation[$numFormation]->addStage($stage);
      $manager->persist($stage);
  }
  $manager->flush();
}
}
