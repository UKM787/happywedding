<?php

return [
    'name' => 'Happyweddd',
    'manifest' => [
        'name' => env('APP_NAME', 'HappyWed'),
        'short_name' => 'HW',
        'start_url' => '/login',
        'background_color' => '#ffffff',
        'theme_color' => '#461952',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'yellow',
        'icons' => [
            '72x72' => [
                'path' => '/assets/PWA/72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/assets/PWA/96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/assets/PWA/128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/assets/PWA/144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/assets/PWA/152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/assets/PWA/192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/assets/PWA/384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/assets/PWA/512x512.png',
                'purpose' => 'any'
            ],
        ],
        // 'shortcuts' => [
        //     [
        //         'name' => 'Shortcut Link 1',
        //         'description' => 'Shortcut Link 1 Description',
        //         'url' => '/shortcutlink1',
        //         'icons' => [
        //             "src" => "/assets/PWA/72x72.png",
        //             "purpose" => "any"
        //         ]
        //     ],
        //     [
        //         'name' => 'Shortcut Link 2',
        //         'description' => 'Shortcut Link 2 Description',
        //         'url' => '/shortcutlink2'
        //     ]
        // ],
        'custom' => []
    ]
];
