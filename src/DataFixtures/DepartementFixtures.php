<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation de 100 departs juste pour voir la pagination
        for ($i = 1; $i <= 100; $i++) {
            $depart = new Departement();

            $depart->setCode("DEPT_" . $i)
                ->setDesignation("Departement numero: " . $i);
            $manager->persist($depart);
            $manager->flush();
        }
    }
}
