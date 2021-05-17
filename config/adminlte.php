<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'source_BT',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<img 
                    class="img-responsive"
                    src="/assets/logo_union.png" 
                    width="300px" 
                    height="120px" 
                    alt="unionLogoType"
                    object-fit="contain"
                />',

    'logo_mini' => '<img 
                        class="img-responsive"
                        height="50px"
                        width="50px"
                        src="/assets/union_mini_icon.png" 
                        object-fit="contain"
                        />
                    ',
    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | light variant: blue-light, purple-light, purple-light, etc.
    |
    */
    'skin' => 'black-light',
    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we have the option to enable a right sidebar.
    | When active, you can use @section('right-sidebar')
    | The icon you configured will be displayed at the end of the top menu,
    | and will show/hide de sidebar.
    | The slide option will slide the sidebar over the content, while false
    | will push the content, and have no animation.
    | You can also choose the sidebar theme (dark or light).
    | The right Sidebar can only be used if layout is not top-nav.
    |
    */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'logout_method' => null,

    'login_url' => 'login',
    'register_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and a URL. You can also specify an icon from Font
    | Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    */

    'menu' => [
        ['header' => ''],
            [
                'text' => 'Painel de Controle',
                'url' => 'home/',
                'icon' => 'fa fa-tachometer',
                'bt_ac' => 'home'
            ],

        ['header' => ''],
            [
                'text' => 'Minha Conta',
                'icon' => 'fas fa-fw fa-user',
                'url' => '/users/perfil',
                'requestjs' => 'AppProfile',
                'bt_ac' => 'users.profile'
            ],
        ['header' => ''],
            [
                'text' => 'Administrativo',
                'icon' => 'fa fa-briefcase',
                'submenu' => [
                    [
                        'text' => 'Projetos',
                        'icon' => 'fa fa-angle-right',
                        'bt_ac' => 'projetos.index'
                    ],
                ],
            ],
        ['header' => ''],
            [
                'text' => 'Cadastros',
                'icon' => 'fa fa-cubes',
                'submenu' => [
                    [
                      'text' => 'Categoria do instrumento',
                      'icon' => 'fa fa-angle-right',
                      'url' => '#',
                      'bt_ac' => 'categoriaInstrumento.index'
                    ],
                    [
                        'text' => 'Checklist de Estrutura',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'checkListEstrutura.index'
                    ],
                    [
                        'text' => 'Checklist de Itens',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'checkListItens.index'
                    ],
                    [
                        'text' => 'Checklist de Modelos',
                        'icon' => 'fa fa-angle-right',
                        'url' =>'#',
                        'bt_ac' => 'checkListModelos.index'    
                    ],
                    [
                        'text' => 'Elemento de Despesa',
                        'icon' => 'fa fa-angle-right',
                        'url' =>'#',
                        'bt_ac' => 'elementoDespesa.index'      
                    ],
                    [
                        'text' => 'Fonte de Recurso',
                        'icon' => 'fa fa-angle-right',
                        'url' =>'#',
                        'bt_ac' => 'fonteRecurso.index'       
                    ],
                    [
                        'text' => 'Modalidade de Apoio',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'modalidadeApoio.index'      
                    ],
                    [
                        'text' => 'Modalidade de Licitação',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'modalidadesLicitacoes.index'
                    ],
                    [
                        'text' => 'Projeto de Atividade',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'projetoAtividades.index'
                    ],
                    [
                        'text' => 'Proponente',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'proponente.index' 
                    ],
                    [
                        'text' => 'Setor',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'setores.index'
                    ],
                    [
                        'text' => 'Tipo de Projetos (Eventos)',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'tiposProjetos.index'
                    ],
                ],
            ],
        ['header' => ''],
            [
                'text' => 'Localidades',
                'icon' => 'fa fa-map-marker',
                'submenu' => [
                    [
                        'text' => 'Localidades',
                        'icon' => 'fa fa-angle-right',
                        'url' => '#',
                        'bt_ac' => 'localidades.index'
                    ],
                    [
                        'text' => 'País',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/paises/',
                        'requestjs' => 'AppPaises',
                        'bt_ac' => 'paises.index'
                    ],
                    [
                        'text' => 'Território Identidade',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/territoriosTuristicos/',
                        'requestjs' => 'AppTerritoriosTuristicos',
                        'bt_ac' => 'territoriosTuristicos.index'
                    ],
                    [
                        'text' => 'Tipo Evento/Festa',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/tiposEventosFestas/',
                        'requestjs' => 'AppTiposEventosFestas',
                        'bt_ac' => 'tiposEventosFestas.index'
                    ],
                    [
                        'text' => 'Tipo Infraestrutura',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/tiposInfraestruturas/',
                        'requestjs' => 'AppTiposInfraestruturas',
                        'bt_ac' => 'tiposInfraestruturas.index'
                    ],
                    [
                        'text' => 'UF',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/uf/',
                        'requestjs' => 'AppUF',
                        'bt_ac' => 'uf.index' 
                    ],
                    [
                        'text' => 'Zona Turística',
                        'icon' => 'fa fa-angle-right',
                        'url' => '/zonasTuristicas/',
                        'requestjs' => 'AppZonasTuristicas',
                        'bt_ac' => 'zonasTuristicas.index'
                    ],
                ],
            ],
        ['header' => ''],
            [
                'text'  => 'Controle de Acesso',
                'icon'  => 'fa fa-lock',
                'submenu' => [
                    [
                        'text' => 'Usuários',
                        'url' => 'users/',
                        'icon' => 'fa fa-angle-right',
                        'requestjs' => 'AppUsers',
                        'bt_ac' => 'users.index'
                    ],
                    [
                        'text' => 'Grupos',
                        'icon' => 'fa fa-angle-right',
                        'url' => 'roles/',
                        'requestjs' => 'AppRoles',
                        'bt_ac' => 'roles.index'
                    ],
                    [
                        'text' => 'Permissões',
                        'url' => 'permissoes/',
                        'icon' => 'fa fa-angle-right',
                        'requestjs' => 'AppPermissoes',
                        'bt_ac' => 'permissoes.index'
                    ],
                ]
            ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'FontAwesome',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
    ],
];
