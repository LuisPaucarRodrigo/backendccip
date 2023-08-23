<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PDF Driver
    |--------------------------------------------------------------------------
    |
    | This is the name of the driver that will be used by Dompdf.
    |
    | Supported: "dompdf", "tcpdf", "wkhtmltopdf"
    |
    */
    'driver' => 'dompdf',

    /*
    |--------------------------------------------------------------------------
    | PDF Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many PDF drivers as you wish, and you may even
    | configure multiple drivers of the same engine. Defaults have been set
    | for each driver as a default of the package.
    |
    */
    'drivers' => [
        'dompdf' => [
            'driver' => 'dompdf',
            'options' => [
                'isRemoteEnabled' => true,
            ],
        ],

        // You may add more drivers here as needed
    ],
];
