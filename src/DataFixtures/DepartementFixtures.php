<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $departements =[
            [
                'code'=>'DEP-INFO-GESTION',
                'name'=>'Informatque'
            ],
        ];
        foreach ($departements as $value) {
            $depart = new Departement();
            $depart->setCode($value['code'])
                ->setDesignation($value['name']);
                $this->addReference($value['code'],$depart);
            $manager->persist($depart);
        }
        $manager->flush();
    }
}
