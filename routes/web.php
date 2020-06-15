<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

if (in_array(env('APP_ENV'), ['local', 'testing']) && env('APP_DEBUG') === true) {
    
    Route::get('/core/test', function () {
        return view('core::examples.admin-grid')->with([ 'title' => 'Grade de Dados de Teste']);
    });
    
    Route::namespace('App\Module\Core\Http\Controllers')->group(function(){
        Route::get('/core/grid', 'ExampleController@index')->name('example');
        Route::get('/core/form', 'ExampleController@create')->name('example');
    });
    
}
