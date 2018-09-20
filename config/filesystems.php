<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        /**
         * Sistema de archivos para galerias
         */
        'galeria' => [
            'driver' => 'local',
            'root' => public_path('galeria'),
            'url' => env('APP_URL').'/galeria',
            'visibility' => 'public',

            /**
             * Sistema de archivos para thumbnail galerias
             */
            'thumbnail' => [
                'driver' => 'local',
                'root' => public_path('galeria/thumbnail'),
                'url' => env('APP_URL').'/galeria/thumbnail',
                'visibility' => 'public',
            ],
        ],

        /**
         * Sistema de archivos para eventos
         */
        'evento' => [
            'driver' => 'local',
            'root' => public_path('evento'),
            'url' => env('APP_URL').'/evento',
            'visibility' => 'public',
        ],

        /**
         * Sistema de archivos para planeamientos
         */
        'planeamiento' => [
            'driver' => 'local',
            'root' => storage_path('app/planeamiento'),
            'url' => preg_replace("/\\\/", "/", storage_path('app/planeamiento')),
        ],

        /**
         * Sistema de archivos para estudiantes
         */
        'estudiante' => [
            'driver' => 'local',
            'root' => storage_path('app/estudiante'),
            'url' => preg_replace("/\\\/", "/", storage_path('app/estudiante')),

            /**
             * Sistema de archivos para foto estudiante
             */
            'foto' => [
                'driver' => 'local',
                'root' => public_path('estudiante'),
                'url' => env('APP_URL').'/estudiante',
                'visibility' => 'public',
            ],
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
