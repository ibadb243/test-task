<?php

use App\Http\Controllers\ContainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('containers', ContainerController::class)->except(['show']);