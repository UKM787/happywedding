<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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

    'msg91' => [
        'sms_authkey' => env('MSG91_SMS_AUTHKEY'),
        'whatsapp_authkey' => env('MSG91_WHATSAPP_AUTHKEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '865743364754534',  //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '23738ee08e476e3277bffefa27135a4b', //'115722ec9ca27ec92b74407da5af5d9a',//USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://happywed.co.in/facebook/callback/'
    ],

    'google' => [
        'client_id'     =>  '375252225988-bebjcrq9fiuraemv8j0l1d4odrv3dcjq.apps.googleusercontent.com',
        'client_secret' =>  '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',
        'redirect'      => 'https://happywed.co.in/google/callback'
    ],

];
