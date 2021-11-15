<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation de 100 formations juste pour voir la pagination
        for ($i = 1; $i <= 100; $i++) {
            $formation = new Formation();

            $formation->setDesignation("DEPT_" . $i)
                ->setCout(rand(100000,1000000));
            $manager->persist($formation);
        }
        $manager->flush();
    }
}
