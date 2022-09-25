<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScoreController;

Route::get('/', function () {
    return redirect()->route('video.index');
});

Route::resource('/video',VideoController::class);
Route::resource('/student',StudentController::class);
Route::resource('/score',ScoreController::class);
