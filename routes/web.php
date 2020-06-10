<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'local') {
    
    dd('xxx');
//     APP_ENV=local
// APP_KEY=base64:ffUAU27QhJ96S8sf+/GkNDZnMi+pvXoFH9Q20AXLm98=
// APP_DEBUG=true

}

Route::get('/core/test', function () {

    return view('module-core::test')->with([
        'title' => 'Teste Um'
    ]);

});

Route::namespace('App\Module\Core\Http\Controllers')->group(function(){

    Route::get('/core/test/two', 'ExampleController@show')->name('example');

});


Route::namespace('App\Module\Core\Http\Controllers')->group(function(){
    Route::get('/core/info', 'InfoController@show')->name('');
});

