<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ORGAMAX API Production Keys
    |--------------------------------------------------------------------------
    |
    | This option defines the default environment variables used when calling
    | the SENDCLOUD API. You can generate your production keys by creating an
    | app on https://account.sendcloud.com/login.
    |
    */

    'consumer_key'    => env('ORGAMAX_API_KEY'),
    'consumer_secret' => env('ORGAMAX_SECRET_KEY'),
    'consumer_iid' => env('ORGAMAX_IID')

];
