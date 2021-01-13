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
    $nbFormation = 6;

    for ($i=0; $i <=$nbFormation ; $i++) {
      $formation = new Formation();
      $formation->setNom($faker->jobTitle);
      $formation->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

      $manager->persist($formation);

    }

    // CREATION DES DONNEES ENTREPRISE
    $activiteEntreprise = array (
      "Bancaire",
      "Web",
      "Base de Donnee",
      "Industrielle",
      "Commerciale"
    );

    $tabEntreprise = array();
    for ($i=0; $i <= 6 ; $i++) {
      $entreprise = new Entreprise();
      $entreprise->setNom($faker->company);
      $entreprise->setAdresse($faker->address);
      $entreprise->setActivite($faker->randomElement($activiteEntreprise));
      $entreprise->setSite($faker->url);

      $manager->persist($entreprise);
      $tabEntreprise[]=$entreprise;
    }

    // CREATION DES DONNEES STAGES
    $nbStage = 6;
    for ($numStage=0; $numStage <= $nbStage; $numStage++) {
      $stage = new Stage();
      $stage -> setIntitule($faker->sentence($nbWords = 6, $variableNbWords = true));
      $stage -> setMission($faker->realText($maxNbChars = 200, $indexSize = 2));
      $stage -> setAdresseMail($faker->email);
      $stage -> addFormation($formation);

      // Création relation
      $numEntreprise = $faker->numberBetween($min = 0, $max = 6);
      $stage -> setEntreprises($tabEntreprise[$numEntreprise]);
      $tabEntreprise[$numEntreprise]->addStage($stage);

      $manager->persist($stage);
    }
    $manager->flush();
  }
}
