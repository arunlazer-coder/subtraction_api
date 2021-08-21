<?php 

return
    [   
        'controllers' => [
                                [
                                    'name'=>'permission'
                                ],
                                [
                                    'name'=>'role'
                                ],
                                [
                                    'name' =>'user',
                                ],
                                [
                                    'name' =>'product',
                                ],
                                [
                                    'name' =>'country',
                                ],
                                [
                                    'name' =>'state',
                                ],
                                [
                                    'name' =>'district',
                                ],
                                [
                                    'name' =>'city',
                                ],
                                [
                                    'name' =>'area',
                                ],
                                [
                                    'name' =>'vehicleType',
                                ],
                                [
                                    'name' =>'customer',
                                ],
                                [
                                    'name' =>'driver',
                                ],
                                [
                                    'name' =>'vehicle',
                                ],
                                [
                                    'name' =>'load',
                                ],
                                [
                                    'name'      =>'loadBooking',
                                ],
                                [
                                    'name' =>'trip',
                                ],
                                [
                                    'name'      =>'tripBooking',
                                ],
                                [
                                    'name'  => 'preference',
                                ],
                                [
                                    'name'  => 'page',
                                ],
                                [
                                    'name'  => 'transporters',
                                    'accessOnly' => 1
                                ],
                                [
                                    'name'  => 'loaders',
                                    'accessOnly' => 1
                                ],
                                [
                                    'name'  => 'masterDb',
                                    'accessOnly' => 1
                                ],
                                [
                                    'name'  => 'settings',
                                    'accessOnly' => 1
                                ],
                                [
                                    'name'  => 'userManagement',
                                    'accessOnly' => 1
                                ]
         ],
        'menus' => [
                      'Dashboard' =>  [
                            'icon' => '<i class="nav-icon fas fa-tachometer-alt">',
                            'controller' => 'dashboard',
                        ], 

                        
                        'Transporters' => [
                            'permission'=> 'transporters',
                            'icon' => '<i class="fas fa-truck nav-icon"></i>',
                            'subMenu' => [ 
                                'Bookings' =>  [
                                    'icon' => '<i class="fas fa-cogs nav-icon">',
                                    'controller' => 'tripBooking',
                                    'restrict'   => ['show']
                                ], 
                                'Transporters' =>  [
                                    'icon' => '<i class="fas fa-cogs nav-icon">',
                                    'controller' => 'customer',
                                    'data'  => 't'    
                                ],
                                'Trips' =>  [
                                    'icon' => '<i class="fas fa-cogs nav-icon">',
                                    'controller' => 'trip',
                                ],  
                                'Vehicle' =>  [
                                    'icon' => '<i class="fas fa-cogs nav-icon">',
                                    'controller' => 'vehicle',
                                ],
                                'Driver' =>  [
                                    'icon' => '<i class="fas fa-cogs nav-icon">',
                                    'controller' => 'driver',
                                ],
                                ]
                            ],

                        'Loaders' => [
                                'permission'=> 'loaders',
                                'icon' => '<i class="fas fa-users nav-icon">',
                                'subMenu' => [ 
                                    'Bookings' =>  [
                                        'icon' => '<i class="fas fa-cogs nav-icon">',
                                        'controller' => 'loadBooking',
                                        'restrict'   => ['show']
                                    ], 
                                    'Customers' =>  [
                                        'icon' => '<i class="fas fa-cogs nav-icon">',
                                        'controller' => 'customer',
                                        'data'  => 'l'    
                                    ],
                                    'Loads' =>  [
                                        'icon' => '<i class="fas fa-cogs nav-icon">',
                                        'controller' => 'load',
                                    ],  
                                    ]
                                ],

                        'Master DB' => [
                                    'permission'=> 'masterDb',
                                    'icon' => '<i class="fas fa-users nav-icon">',
                                    'subMenu' => [ 
                                        'VehicleType' =>  [
                                            'icon' => '<i class="fas fa-cogs nav-icon">',
                                            'controller' => 'vehicleType',
                                        ], 
                                        ]
                                    ], 

                        'Preferences' =>  [
                            'icon' => '<i class="nav-icon fas fa-tachometer-alt">',
                            'controller' => 'preference',
                        ], 
                        
                        'Pages' =>  [
                            'icon' => '<i class="nav-icon fas fa-tachometer-alt">',
                            'controller' => 'page',
                        ], 
                        
                        'Settings' =>  [
                            'permission'=> 'settings',                            
                            'icon' => '<i class="fas fa-users nav-icon">',
                            'subMenu' => [  
                                            'Country' =>  [
                                                'icon' => '<i class="fas fa-cogs nav-icon">',
                                                'controller' => 'country',
                                            ], 

                                            'State' =>  [
                                                'icon' => '<i class="fas fa-cogs nav-icon">',
                                                'controller' => 'state',
                                            ],

                                            'District' =>  [
                                                'icon' => '<i class="fas fa-cogs nav-icon">',
                                                'controller' => 'district',
                                            ],

                                            'City' =>  [
                                                'icon' => '<i class="fas fa-cogs nav-icon">',
                                                'controller' => 'city',
                                            ],

                                            'Area' =>  [
                                                'icon' => '<i class="fas fa-cogs nav-icon">',
                                                'controller' => 'area',
                                            ],
                            ]
                        ],

                        'User Management' =>  [
                            'permission'=> 'userManagement',
                            'icon' => '<i class="fas fa-users nav-icon">',
                            'subMenu' => [  
                                            'Permissions' => [
                                                'icon'       => '<i class="fas fa-unlock-alt nav-icon">',
                                                'controller' =>  'permission'
                                            ],
                                            'Roles' => [
                                                'icon'       => '<i class="fas fa-briefcase nav-icon">',
                                                'controller' =>  'role'
                                            ],
                                            'Users' => [
                                                'icon'       => '<i class="fas fa-user nav-icon">',
                                                'controller' =>  'user'
                                            ],
                            ]
                        ], 
                        
            ],
    ];