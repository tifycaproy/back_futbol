<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'sendinblue' => [
       'url' => 'https://api.sendinblue.com/v2.0',
       'key' => env('SENDINBLUE_KEY'),
    ],
    
    'firebase' => [
    'api_key' => 'AIzaSyCgzju5BGVfEsjxg4g1EbD4UeCMoEss-AI', // Only used for JS integration
    'auth_domain' => 'millos-fc-app.firebaseapp.com', // Only used for JS integration
    'database_url' => 'https://millos-fc-app.firebaseio.com',
    'secret' => '09zkv7DtInEOfc0w3fwnZfqtVZkBjDOkvB4NqGoQ',
    'storage_bucket' => 'millos-fc-app.appspot.com', // Only used for JS integration
    ],

];
