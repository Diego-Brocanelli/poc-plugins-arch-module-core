<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'local' && env('APP_DEBUG') === true) {
    
    Route::get('/core/test', function () {
        return view('module-core::test')->with([ 'title' => 'Teste Um']);
    });
    
    Route::namespace('App\Module\Core\Http\Controllers')->group(function(){
        Route::get('/core/test/two', 'ExampleController@show')->name('example');
        Route::get('/core/info', 'InfoController@show')->name('');
    });
    
}




