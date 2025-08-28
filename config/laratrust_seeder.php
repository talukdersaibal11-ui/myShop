<?php

return [
    'create_users' => false,

    'truncate_tables' => true,

    'roles_structure' => [
        'super-admin' => [
            'users'        => 'c,r,u,d',
            'category'     => 'c,r,u,d',
            'sub-category' => 'c,r,u,d',
            'brand'        => 'c,r,u,d',
            'color'        => 'c,r,u,d',
            'size'         => 'c,r,u,d',
            'order'        => 'c,r,u,d',
            'supplier'     => 'c,r,u,d',
            'role'         => 'c,r,u,d',
            'permission'   => 'c,r,u,d',
        ],
        'admin' => [
            'category'     => 'c,r,u,d',
            'sub-category' => 'c,r,u,d',
            'brand'        => 'c,r,u,d',
            'color'        => 'c,r,u,d',
            'size'         => 'c,r,u,d',
            'order'        => 'c,r,u,d',
            'supplier'     => 'c,r,u,d',
        ],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
