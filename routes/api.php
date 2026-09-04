<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/data', [NavigationController::class, 'GetWebsiteData']);
