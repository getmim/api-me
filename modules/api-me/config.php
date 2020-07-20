<?php

return [
    '__name' => 'api-me',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-me.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-me' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-user' => NULL
            ],
            [
                'lib-form' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiMe\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-me/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiMeProfile' => [
                'path' => [
                    'value' => '/me'
                ],
                'method' => 'GET',
                'handler' => 'ApiMe\\Controller\\Profile::info'
            ],
            'apiMeProfileChange' => [
                'path' => [
                    'value' => '/me/profile'
                ],
                'method' => 'PUT',
                'handler' => 'ApiMe\\Controller\\Profile::change'
            ],
            'apiMePasswordChange' => [
                'path' => [
                    'value' => '/me/password'
                ],
                'method' => 'PUT',
                'handler' => 'ApiMe\\Controller\\Password::change'
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'api-me.password' => [
                'old' => [
                    'type' => 'password',
                    'label' => 'Old Password',
                    'rules' => [
                        'required' => true 
                    ]
                ],
                'new' => [
                    'type' => 'password',
                    'label' => 'New Password',
                    'rules' => [
                        'required' => true,
                        'length' => [
                            'min' => 6
                        ]
                    ]
                ],
                'retype' => [
                    'type' => 'password',
                    'label' => 'Retype Password',
                    'rules' => [
                        'required' => true 
                    ]
                ]
            ],
            'api-me.profile' => [
                'name' => [
                    'label' => 'Username',
                    'type' => 'text',
                    'rules' => [
                        'empty' => FALSE,
                        'text' => 'alnumdash',
                        'unique' => [
                            'model' => 'LibUser\\Library\\Fetcher',
                            'field' => 'name',
                            'self' => [
                                'service' => 'user.id',
                                'field' => 'id'
                            ]
                        ]
                    ]
                ],
                'fullname' => [
                    'label' => 'Fullname',
                    'type' => 'text',
                    'rules' => [
                        'empty' => FALSE
                    ]
                ],
                'avatar' => [
                    'label' => 'Avatar',
                    'type' => 'image',
                    'form' => 'std-image',
                    'modules' => ['lib-upload'],
                    'rules' => [
                        'upload' => 'std-image'
                    ]
                ]
            ]
        ]
    ]
];