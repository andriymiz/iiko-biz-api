<?php

return [

    'api_base_uri' => env('IIKO_BIZ_API_BASE_URI', 'https://iiko.biz:9900/api/0/'),

    'user_id' => env('IIKO_BIZ_USER_ID', ''),

    'user_secret' => env('IIKO_BIZ_USER_SECRET', ''),

    // file. Example: 'storage_path('/logs/iiko.log')
    'logging' => null,
];
