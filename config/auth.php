<?php

return 
[
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    
    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'EmployeeModel',
        ],
    ],

    // 'providers' => [
    //     'users' => [
    //         'driver' => 'eloquent',
    //         'model'  =>  App\EmployeeModel::class,
    //     ]
    // ]
];