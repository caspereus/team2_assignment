<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return redirect()->route('video.index');
});

Route::resource('/video',VideoController::class);
