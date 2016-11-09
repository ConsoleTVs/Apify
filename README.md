# Apify
## API generator for Laravel 5

[![StyleCI](https://styleci.io/repos/73238760/shield?branch=master)](https://styleci.io/repos/73238760)
![StyleCI](https://img.shields.io/badge/Built_for-Laravel-green.svg?style=flat-square)
![StyleCI](https://img.shields.io/github/license/consoletvs/apify.svg?style=flat-square)

![Apify Logo](http://i.imgur.com/cW6EpHY.png)

## Table Of Contents

-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Usage](#usage)

## Installation

To install apify use composer

### Download

```
composer require consoletvs/apify
```

### Add service provider & alias

Add the following service provider to the array in: ```config/app.php```

```php
ConsoleTVs\Apify\ApifyServiceProvider::class,
```

### Publish the assets

```
php artisan vendor:publish
```

## Configuration

To configure the package go to: ```config/apify.php```

The default file have a valid example and it's documented, check it out, should look like this:

```php
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

            'id', 'name', 'email', 'created_at', 'updated_at'

        ],

    ],
];
```

## Usage

Visit the endpoint like this:

```
Website URL + /api/ + Prefix + /{table}/{accessor?}/{data?}
```

*table:* is the table you want to look at, must be an index of the table array in the configuration.

*accessor:* is optional, and it's the colum to filter data.

*data:* is the data you're filtering, you can add multiple data separated with a ,

**Note:** Remember that all calls to the API goes first to the ```api``` middleware, if you need to modify the api throttle go to: ```App\Http\Kernel.php``` and modify the api throttle.

```php
'api' => [
    'throttle:60,1',
    'bindings',
],
```

The ```60``` determines the max calls / minute.

The ```1``` determines the minutes to wait if the max calls are exceded.

Some examples:

```
http://localhost/web/Laralum3/public/api/apify/users (example URL)
```

```json
{"users":[{"id":1,"name":"\u00c8rik Campobadal","email":"ConsoleTVs@gmail.com","created_at":"2016-09-22 16:13:28","updated_at":"2016-10-02 11:18:25"},{"id":2,"name":"Second User","email":"ConsoleTV2s@gmail.com","created_at":"2016-09-21 16:13:28","updated_at":"2016-09-22 16:20:00"},{"id":3,"name":"Third User","email":"ConsoleTV3s@gmail.com","created_at":"2016-08-22 16:13:28","updated_at":"2016-09-22 16:20:00"}]}
```

```
http://localhost/web/Laralum3/public/api/apify/users/email/ConsoleTVs@gmail.com,ConsoleTV3s@gmail.com (example URL)
```

```json
{"users":[{"id":1,"name":"\u00c8rik Campobadal","email":"ConsoleTVs@gmail.com","created_at":"2016-09-22 16:13:28","updated_at":"2016-10-02 11:18:25"},{"id":3,"name":"Third User","email":"ConsoleTV3s@gmail.com","created_at":"2016-08-22 16:13:28","updated_at":"2016-09-22 16:20:00"}]}
```
