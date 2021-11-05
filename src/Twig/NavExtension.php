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
            'app'=>
            [

            ],
            'admin'=>
            [
                [
                    'name'=>'Formation',
                    'icon'=>'fas fa-home',
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
                    "name"=>'Matiere',
                    "icon"=>'fas fa-book',
                    'links'=>[
                        [
                            'name'=>'Matieres',
                            'path'=>'admin_matiere_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_matiere_new'
                        ]
                    ]
                ],
                [
                    'name'=>'Departement',
                    'icon'=>'fas fa-home',
                    'links'=>[
                        [
                            'name'=>'Departements',
                            'path'=>'admin_departement_index'
                        ],
                        [
                            'name'=>'New',
                            'path'=>'admin_departement_new'
                        ]
                    ]
                ],
                [
                    'name'=>'user',
                    'icon'=>'fas fa-users',
                    'links'=>[
                        [
                            'name'=>$this->translator->trans('Users'),
                            'path'=>'user_index',
                        ],
                        [
                            'name'=>$this->translator->trans('New'),
                            'path'=>'user_new',
                        ],
                    ]
                ]
            ],
            'user'=>
            [
                
            ],
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
        ];
    }
}