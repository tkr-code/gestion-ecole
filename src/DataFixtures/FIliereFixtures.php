<?php

namespace App\DataFixtures;

use App\Entity\Filiere;
use App\Entity\OptionFiliere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FIliereFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $filiers = [
            [
                'code'=>'IG1',
                'name'=>'Informatique de gestion première année'
            ],
            [
                'code'=>'IG2',
                'name'=>'Informatique de gestion deuxèmme année',
                'options'=>[
                    [
                        'code'=>'AP',
                        'name'=>'Analyste programmeur',
                    ],
                    [
                        'code'=>'RT',
                        'name'=>'Réseaux et Télécomunication'
                    ]
                ]
            ],
            [
                'code'=>'IG3',
                'name'=>'Informatique de gestion troisièmme année',
                'options'=>[
                    [
                        'code'=>'GL',
                        'name'=>'Genie logiciel',
                    ],
                    [

                        'code'=>'RI',
                        'name'=>'Réseaux informatique'
                    ]
                ]
            ],
        ];
        foreach ($filiers as $key => $value) {
            $filier = new Filiere();
            $filier->setCode($value['code'])
            ->setDesignation($value['name']);
            if(!empty($value['options'])){
                foreach ($value['options'] as $key => $op) {
                    $optionFIlier = new OptionFiliere();
                    $optionFIlier->setCode($op['code']);
                    $optionFIlier->setDesignation($op['name']);
                    $filier->addOption($optionFIlier);
                }
            }
           $filier->setDepartement($this->getReference('DEP-INFO-GESTION'));
            $manager->persist($filier);
        }

        $manager->flush();
    }
    public function getDependencies(){
        return [
            FormationFixtures::class
        ];
    }
}
