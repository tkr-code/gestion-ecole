<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MatiereFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation de 100 matieres juste pour voir la pagination
        for ($i = 1; $i <= 100; $i++) {
            $matiere = new Matiere();

            $matiere->setCode("Mat_" . $i)
                ->setDesignation("Matiere numero: " . $i);
            $manager->persist($matiere);
            $manager->flush();
        }
    }
}
