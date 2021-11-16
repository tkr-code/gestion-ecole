<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formations = [
            [
                'name'=>'Informatique de gestion 1 ere et 2 eme annneé',
                'cout'=>629000
            ],
            [
                'name'=>'Génie civil',
                'cout'=>629000
            ],
        ];
        foreach($formations as $value) {
            $formation = new Formation();
            $formation->setDesignation($value['name'])
                ->setEtat('Activer')
                ->setCout($value['cout']);
            $manager->persist($formation);
        }
        $manager->flush();
    }
}
