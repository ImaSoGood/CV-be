<?php

use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('{access}/{url}', function () {
    return view('accessor');
});*/

Route::get('access/{url}', [PanelController::class, 'GetAccessView']);

