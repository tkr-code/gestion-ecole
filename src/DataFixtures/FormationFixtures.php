<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formations =
        [
            [
                'nom'=>'Informatique de gestion',
                'cout'=>'729000',
                'etat'=>'Activer'
            ],
            [
                'nom'=>'Genie civil',
                'cout'=>'729000',
                'etat'=>'Désactiver'
            ],
        ];
        
        foreach($formations as $key =>$v)
        {
            $formation = new Formation();
            $formation->setDesignation($v['nom'])
            ->setCout($v['cout'])
            ->setEtat($v['etat']);
            $manager->persist($formation);
        }

        $manager->flush();
    }
}
