<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ibm = new Entreprise();
        $ibm->setNom("IBM");
        $ibm->setActivite("Bancaire");
        $ibm->setAdresse("17 rue Ibm, 64100 Bayonne");
        $ibm->setSite("wwww.ibm.com");
        $manager->persist($ibm);

        $manager->flush();
    }
}
