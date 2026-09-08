<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/resume', [DataController::class, 'GetResumeData']);
Route::get('/owner', [DataController::class, 'GetOwnerData']);
Route::get('/work', [DataController::class, 'GetWorkData']);
