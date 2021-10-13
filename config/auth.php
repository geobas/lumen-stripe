<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Auth guard configuration
    |--------------------------------------------------------------------------
    |
    | We set the defaults guard to api and the api guards is ordered to
    | use 'fake-login' driver.
    |
    */

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'fake-login',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class,
        ],
    ],
];
