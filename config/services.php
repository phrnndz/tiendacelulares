<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */


    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    
    'mercadopago' => [
        'base_uri'      => env('MERCADOPAGO_BASE_URI'),
        'key'           => env('MERCADOPAGO_CLIENT_KEY'),
        'secret'        => env('MERCADOPAGO_CLIENT_SECRET'),
        'class'         => App\Services\MercadoPagoService::class,
        'base_currency' =>'MXN',
        'client_id'     => env('MERCADOPAGO_CHECKOUTBASICO_CLIENT_ID'),
        'client_secret' => env('MERCADOPAGO_CHECKOUTBASICO_CLIENT_SECRET'),


    ],
    
    'currency_conversion' => [
        'base_uri'      => env('CURRENCY_CONVERSION_BASE_URI'),
        'api_key'           => env('CURRENCY_CONVERSION_CLIENT_KEY'),
    ],


];
