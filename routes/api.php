<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/weather', [WeatherController::class, 'getCurrentWeatherByCity']);
