<?php

namespace App\Controller\Professeur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    /**
     * @Route("/professeur/", name="professeur_index")
     */
    public function index(): Response
    {
        return $this->render('professeur/professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
        ]);
    }
    /**
     * @Route("/professeur/classe", name="professeur_classe")
     */
    public function classe(): Response
    {
        return $this->render('professeur/classe/index.html.twig', [
        ]);
    }
}
