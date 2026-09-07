<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('/resume', [ResumeController::class, 'GetResumeData']);
Route::get('/owner', [OwnerController::class, 'GetOwnerData']);
