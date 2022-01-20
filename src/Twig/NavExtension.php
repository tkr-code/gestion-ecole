<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Contracts\Translation\TranslatorInterface;

class NavExtension extends AbstractExtension
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('sidebar', [$this, 'getNavs'])
        ];
    }

    public function getNavs()
    {
        return 
        [
            'dashboard'=>
            [
                [
                    'name'=>$this->translator->trans('Dashboard'),
                    'icon'=>'fas fa-tachometer-alt',
                    'links'=>[
                        [
                            'name'=>$this->translator->trans('Dashboard').' 1',
                            'path'=>'admin'
                        ]
                    ]
                ],
                [
                    'name'=>'Profil',
                    'path'=>'profile_index',
                ],
                [
                    'name'=>'Gestion ecole',
                    'icon'=>'fa fa-home',
                    'links'=>
                        [
                            [
                                'name'=>$this->translator->trans('Home'),
                                'path'=>'home'
                            ]
                        ]
                ],
            ],
            'user'=> [],
            'professeur'=> [
                [
                    'name'=>'Classe',
                    'path'=>'professeur_classe'
                ]
            ],
            'admin'=>
            [
                [
                    'name'=>'Inscription',
                    'path'=>'admin_inscription'
                ],
                [
                    'name'=>'Etudiant',
                    'links'=>[
                        [
                            'name'=>'Etudiants',
                            'path'=>'admin_etudiant_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_etudiant_new'
                        ],
                    ]
                ],
                [
                    'name'=>'Professeur',
                    'links'=>[
                        [
                            'name'=>'Professeurs',
                            'path'=>'admin_professeur_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_professeur_new'
                        ],
                    ]
                ],
                [
                    "name" => 'Matière',
                    'links' => [
                        [
                            'name' => 'Matières',
                            'path' => 'admin_matiere_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_matiere_new'
                        ]
                    ]
                ],
                [
                    "name" => 'Note',
                    'links' => [
                        [
                            'name' => 'Notes',
                            'path' => 'admin_note_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_note_new'
                        ]
                    ]
                ],
                [
                    'name'=>'Salle',
                    'links'=>[
                    [
                        'name'=>'Salles',
                        'path'=>'admin_salle_index'
                    ],
                    [
                        'name'=>'New',
                        'path'=>'admin_salle_new'
                    ],
                    ]

                ],
                [
                    'name'=>'Cour',
                    'links'=>[
                        [
                            'name'=>'Cours',
                            'path'=>'admin_cour_index'
                        ]
                    ]
                ],
                [
                    'name' => 'Classe',
                    'links' => 
                    [
                        [
                            'name' => 'Classes',
                            'path' => 'admin_classe_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_classe_new'
                        ]
                    ]
                ],
                [
                    'name' => 'Formation',
                    'links' => 
                    [
                        [
                            'name' => 'Formations',
                            'path' => 'admin_formation_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_formation_new'
                        ]
                    ]
                ],
                [
                    'name' => 'Departement',
                    'links' => [
                        [
                            'name' => 'Departements',
                            'path' => 'admin_departement_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_departement_new'
                        ]
                    ]
                ],
                [
                    'name' => 'Filiere',
                    'icon' => '',
                    'links' =>
                    [
                        [
                            'name' => 'Filieres',
                            'path' => 'admin_filiere_index'
                        ],
                        [
                            'name' => 'New',
                            'path' => 'admin_filiere_new'
                        ]
                    ]
                ],
                [
                    'name' => 'user',
                    'icon' => 'fas fa-users',
                    'links' => [
                        [
                            'name' => $this->translator->trans('Users'),
                            'path' => 'user_index',
                        ],
                        [
                            'name' => $this->translator->trans('New'),
                            'path' => 'user_new',
                        ],
                    ]
                ]
            ]
        ];
    }
}
