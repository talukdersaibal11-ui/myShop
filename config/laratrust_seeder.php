<?php

return [
    'create_users' => false,

    'truncate_tables' => true,

    'roles_structure' => [
        'super-admin' => [
            'users' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'sub-category' => 'c,r,u,d',
            'brand' => 'c,r,u,d',
            'color' => 'c,r,u,d',
            'size' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
