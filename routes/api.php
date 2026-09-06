<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ResumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/data', [ResumeController::class, 'GetResumeData']);
