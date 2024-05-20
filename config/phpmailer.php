<?php

return [
    'host' => env('PHPMAILER_HOST', 'smtp.gmail.com'),
    'port' => env('PHPMAILER_PORT', 587),
    'username' => env('PHPMAILER_USERNAME', 'seylonaquaticss@gmail.com'),
    'password' => env('PHPMAILER_PASSWORD', 'ytdd qrlg uckq tsup'),
    'encryption' => env('PHPMAILER_ENCRYPTION', 'tls'), // Can be 'tls' or 'ssl'
    'from_address' => env('PHPMAILER_FROM_ADDRESS', 'seylonaquaticss@gmail.com'),
    'from_name' => env('PHPMAILER_FROM_NAME', '"Seylon Aquatics (Pvt) Ltd.'),
];
