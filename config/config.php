<?php

return [

    'manager_email' => env('MANAGER_EMAIL'),
    'manager_password' => password_hash(env('MANAGER_PASSWORD'), PASSWORD_DEFAULT),

    'telegramMessage' => [
        'token' => env('TELEGRAM_TOKEN'),
        'manager_chatid' => env('TELEGRAM_MANAGER_CHATID'),
        'curlopt_proxy' => env('CURLOPT_PROXY'),
        'curlopt_proxyuserpwd' => env('CURLOPT_PROXYUSERPWD'),
    ],

];
