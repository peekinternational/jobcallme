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

    'facebook' => [
        'client_id' => '377749349357447',
        'client_secret' => 'dd4c2236c3c3c64a397efbb3b40f5832',
<<<<<<< HEAD
     //'redirect' =>  url('fbCallback'),
=======
      // 'redirect' =>  url('fbCallback'),
>>>>>>> 1e6f5e5684fe5f8cde58f33ce5c6e0aab9934f10
    ],

    'google' => [
        'client_id' => '821126400778-i3ca74in5m8i2m8n0dcvccnktpidae08.apps.googleusercontent.com',
        'client_secret' => 'smr0ucFyrp9aZcKfwnbkkorf',
<<<<<<< HEAD
        //'redirect' => url('googleCallback'),
=======
       // 'redirect' => url('googleCallback'),
>>>>>>> 1e6f5e5684fe5f8cde58f33ce5c6e0aab9934f10
    ],
    'linkedin' => [
        'client_id' => '818xstq8efstw9',
        'client_secret' => 'j094fcTdDgY7Mx6b',
<<<<<<< HEAD
       //'redirect' => url('lnCallback'),
=======
      //'redirect' => url('lnCallback'),
>>>>>>> 1e6f5e5684fe5f8cde58f33ce5c6e0aab9934f10
    ], 
];
