<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        \App\Models\Admin::class => [
            'salt' => \App\Models\Admin::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Area::class => [
            'salt' => \App\Models\Area::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\AsesorAcademico::class => [
            'salt' => \App\Models\AsesorAcademico::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\AsesorIndustrial::class => [
            'salt' => \App\Models\AsesorIndustrial::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Carrera::class => [
            'salt' => \App\Models\Carrera::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\CicloEscolar::class => [
            'salt' => \App\Models\CicloEscolar::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Cuatrimestre::class => [
            'salt' => \App\Models\Cuatrimestre::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Empresa::class => [
            'salt' => \App\Models\Empresa::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Estudiante::class => [
            'salt' => \App\Models\Estudiante::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Grupo::class => [
            'salt' => \App\Models\Grupo::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\Solicitud::class => [
            'salt' => \App\Models\Solicitud::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

        \App\Models\TipoDeUsuario::class => [
            'salt' => \App\Models\TipoDeUsuario::class . '7623e9b0009feff8e024a689d6ef59ce',
            'length' => 10,
        ],

    ],

];
