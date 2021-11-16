<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MatiereFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $matiers =[
            [
                'name'=>'Mathématique',
                'code'=>'Math',
            ],
            [
                'name'=>'Php',
                'code'=>'Php'
            ],
            [
                'name'=>"Technique d'expression",
                'code'=>'TE'
            ]
        ];
        foreach($matiers as $value){
        $matiere = new Matiere();
            $matiere
            ->setCode($value['code'])
            ->setDesignation($value['name']);
            $manager->persist($matiere);
        }
        $manager->flush();
    }
}
