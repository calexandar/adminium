<?php

return [
    /****************************************
    *   HOMEPAGE SETTINGS
    ****************************************/
    'contact_settings' => [
        "fields" => [ 
            "phone" => [
                'type'  => 'text',
                'name'  => 'phone',
                'label' => 'Phone',
                'default' => ""
            ],
            "email" => [
                "type" => "email",
                "name" => "email",
                "label" => "Email",
                "default" => ""
            ]
        ]
    ]
];