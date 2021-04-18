<?php

use ScadaUnity\Money\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Money Stack
    |--------------------------------------------------------------------------
    |
    | This configuration value informs Money which "stack" you will be
    | using for your application. In general, this value is set for you
    | during installation and will not need to be changed after that.
    | Avaliable stacks: livewire, inertia
    |
    */

    'stack' => 'inertia',

    /*
     |--------------------------------------------------------------------------
     | Money Route Middleware
     |--------------------------------------------------------------------------
     |
     | Here you may specify which middleware Money will assign to the routes
     | that it registers with the application. When necessary, you may modify
     | these middleware; however, this default value is usually sufficient.
     |
     */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Money's features are optional. You may disable the features
    | by removing them from this array. You're free to only remove some of
    | these features or you can even remove all of these if you need to.
    |
    */

    'features' => [
        Features::createCategory(),
    ],

];
