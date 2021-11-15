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
    public function getFunctions():array
    {
        return[
            new TwigFunction('sidebar',[$this,'getNavs'])
        ];
    }
    public function li(){
        
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
            'user'=>
            [
                [
                    'name'=>'Professeur',
                    'links'=>[
                        [
                            'name'=>'Professeurs',
                            'path'=>'admin_professeur_index'
                        ],
                        [
                            'name'=>'Nouveau Professeur',
                            'path'=>'admin_professeur_new'
                        ],
                    ]
                ]
            ],
            'admin'=>
            [
                [
                    'name'=>'Formation',
                    'links'=>[
                        [
                            'name'=>'Formations',
                            'path'=>'admin_formation_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_formation_new'
                        ]
                    ]
                ],
                [
                    'name'=>'Classe',
                    'links'=>[
                        [
                            'name'=>'Classes',
                            'path'=>'admin_classe_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_classe_new'
                        ]
                    ]
                ],
                [
                    'name'=>'User',
                    'icon'=>'fas fa-users',
                    'links'=>[
                        [
                            'name'=>$this->translator->trans('Users'),
                            'path'=>'user_index',
                        ],
                        [
                            'name'=>$this->translator->trans('New User'),
                            'path'=>'user_new',
                        ],
                    ]
                ]
            ],
        ];
    }
}