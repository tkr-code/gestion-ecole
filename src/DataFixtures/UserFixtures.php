<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $em;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->em = $entityManagerInterface;
        $this->passwordEncoder = $userPasswordHasherInterface;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = array(
        array('first_name' => 'Malick','last_name' => 'Tounkara','email' => 'admin@mail.com',
                'roles' => ["ROLE_ADMIN"]),
        array('first_name' => 'Mamadou','last_name' => 'Dieme','email' => 'editor@mail.com',
                'roles' => ["ROLE_EDITOR"]),
        array('first_name' => 'Pepin','last_name' => 'Ngoulou','email' => 'user@mail.com',
                'roles' => ["ROLE_USER"]),
        );

        foreach ($users as $value) {
            $user = new User();
            $personne = new Personne();

            $personne->setPrenom($value['first_name'])
                     ->setNom($value['last_name']);
            
            $this->em->persist($personne);


            $user->setEmail($value['email'])
                 ->setIsVerified(true)
                 ->setPassword($this->passwordEncoder->hashPassword($user,'password'))
                 ->setRoles($value['roles'])
                 ->setEtat('Activer')
                 ->setPersonne($personne);

            $this->em->persist($user);

            $this->em->flush();

        }
    }
}