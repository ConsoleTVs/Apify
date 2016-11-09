<?php

if (config('apify.enabled')) {
    Route::group(['middleware' => 'api', 'namespace' => 'ConsoleTVs\Apify\Controllers', 'prefix' => 'api/'.config('apify.prefix'), 'as' => 'apify::'], function () {
        Route::get('/{table}/{accessor?}/{data?}', 'ApifyController@table')->name('table');
    });
}
