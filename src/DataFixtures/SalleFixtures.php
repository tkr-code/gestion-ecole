<?php

namespace App\DataFixtures;

use App\Entity\Salle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SalleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $salles = 
        [
            [
                'name'=>'Alexandre',
                'numero'=>'19'
            ],
            [
                'name'=>'Informatque 2',
                'numero'=>'24'
            ],
            [
                'name'=>'Cisco',
                'numero'=>'24'
            ],
        ];
        foreach($salles as $value){

            $salle = new Salle();
            $salle->setNom($value['name'])
            ->setNumero($value['numero']);
            $manager->persist($salle);
        }
        $manager->flush();
    }
}
