<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prefix used to access the API
    |--------------------------------------------------------------------------
    */
    'prefix' => 'apify',

    /*
    |--------------------------------------------------------------------------
    | Enables or disabled the whole API endpoints
    |--------------------------------------------------------------------------
    */
    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | The tables enabled for the api and it's columns
    |--------------------------------------------------------------------------
    */
    'tables' => [

        // Specify all the tables below

        'users' => [

            // The columns from the table that will be displayed in the JSON

            'id', 'name', 'email', 'created_at', 'updated_at',

        ],

    ],
];
