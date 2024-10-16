<?php

use Illuminate\Http\Request;

//ADMIN/MANAGEMENT APIs
//Role required: admin, manager

Route::group([    
    'middleware' => ['api','auth:api','roles:super-admin,manager'],    
    'prefix' => 'admin/',        
], function () {
    
    Route::group([
        'namespace' => 'Libraries',
        'prefix' => 'libraries',        
        'as' => 'api.v1.admin.libraries.',
    ], function () {    
        
        Route::get('', 'AdminLibraryController@index')->name('index');    
        //Route::post('', 'AdminLibraryController@create')->name('create');
        Route::delete('{id}', 'AdminLibraryController@delete')->where('id', '[0-9]+')->name('delete'); 
        Route::put('{id}/changestatus', 'AdminLibraryController@changeStatus')->where('id', '[0-9]+')->name('changeStatus');
        Route::get('{id}', 'AdminLibraryController@show')->where('id', '[0-9]+')->name('show');        
        Route::put('{id}', 'AdminLibraryController@update')->where('id', '[0-9]+')->name('update');  

        Route::get('{id}/identifiers', 'AdminIdentifierLibraryController@index')->name('index');
        //Route::post('{id}/identifiers', 'AdminIdentifierLibraryController@store')->name('store');        
        //Route::put('{id}/identifiers/{library_identifier}', 'AdminIdentifierLibraryController@update')->name('update');        
        //Route::get('{id}/identifiers/{library_identifier}', 'AdminIdentifierLibraryController@show')->name('show');
        //Route::delete('{id}/identifiers/{library_identifier}', 'AdminIdentifierLibraryController@delete')->name('delete'); //hard delete        
    
        
        //Route::get('{id}/subscriptions', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->name('showsubscr');        
        //Route::put('{id}/subscriptions/{subid}', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->where('subid', '[0-9]+')->name('edotsubscr');        
        //Route::delete('{id}/subscriptions/{subid}', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->where('subid', '[0-9]+')->name('delsubscr');        
    
    }); 

    Route::group([
        'namespace' => 'Institutions',
        'prefix' => 'institutions',        
        'as' => 'api.v1.admin.institutions.',
    ], function () {    
        
        Route::get('', 'AdminInstitutionController@index')->name('index');    
        Route::get('option-items', 'AdminInstitutionController@optionList')->name('option-items');
        Route::post('', 'AdminInstitutionController@create')->name('create');
        Route::delete('{id}', 'AdminInstitutionController@delete')->where('id', '[0-9]+')->name('delete'); 
        Route::get('{id}', 'AdminInstitutionController@show')->where('id', '[0-9]+')->name('show');
        Route::put('{id}', 'AdminInstitutionController@update')->where('id', '[0-9]+')->name('update');
        Route::put('{id}/changestatus', 'AdminInstitutionController@changeStatus')->where('id', '[0-9]+')->name('changeStatus');
        
        Route::get('institution-types/{id}', 'InstitutionTypeController@show')->where('id', '[0-9]+')->name('show');
        Route::put('institution-types/{id}', 'InstitutionTypeController@update')->name('update');
        Route::delete('institution-types/{id}', 'InstitutionTypeController@delete')->where('id', '[0-9]+')->name('delete'); 
        Route::post('institution-types', 'InstitutionTypeController@store')->name('store');
        
        

        //TODO
        //Route::get('consortia', 'ConsortiumController@index')->name('index');
        //Route::put('consortia/{id}', 'ConsortiumController@update')->name('update');
        //Route::post('consortia', 'ConsortiumController@store')->name('store');
        
        
    
                    
        //Route::get('{id}/subscriptions', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->name('showsubscr');        
        //Route::put('{id}/subscriptions/{subid}', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->where('subid', '[0-9]+')->name('edotsubscr');        
        //Route::delete('{id}/subscriptions/{subid}', 'AdminLibraryController@subscriptions')->where('id', '[0-9]+')->where('subid', '[0-9]+')->name('delsubscr');        
    
    }); 

    Route::group([
        'namespace' => 'Stats',
        'prefix' => 'stats',        
        'as' => 'api.v1.admin.stats.',
    ], function () {    
        //    Route::get('/eltest', 'AdminStatsController@eltest')->name('eltest');
        //    Route::get('/eltest2', 'AdminStatsController@eltest2')->name('eltest2');
        Route::get('/avg-working-time', 'AdminStatsController@getAvgWorkingTime')->name('getAvgWorkingTime');
        Route::get('/borrowing-requests-stats', 'AdminStatsController@getBorrowingStats')->name('getBorrowingStats');
        Route::get('/requests-countries-leaderboard', 'AdminStatsController@getRequestsCountriesLeaderboard')->name('getRequestsCountriesLeaderboard');
        Route::get('/requests-countries-library', 'AdminStatsController@getRequestsCountriesFromLibrary')->name('getRequestsCountriesFromLibrary');
        Route::get('/requests-countries', 'AdminStatsController@getRequestsCountriesFromCountry')->name('getRequestsCountriesFromCountry');
    });

});