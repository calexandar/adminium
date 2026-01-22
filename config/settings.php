<?php

declare(strict_types=1);

return [
    /****************************************
    *   HOMEPAGE SETTINGS
    ****************************************/
    'contact_settings' => [
        'fields' => [
            'phone' => [
                'type' => 'text',
                'name' => 'phone',
                'label' => 'Phone',
                'default' => '',
            ],
            'email' => [
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'default' => '',
            ],
            'menu-color' => [
                'type'  => 'colorpicker',
                'name'  => 'menu-color',
                'label' => 'Menu text color',
                'default' => '#ed017e'
            ],
        ],
    ],
];
