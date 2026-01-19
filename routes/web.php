<?php

use Accelade\Grids\Http\Controllers\GridsDemoController;
use Illuminate\Support\Facades\Route;

// Demo routes (only in development)
if (config('grids.demo.enabled', false)) {
    Route::prefix(config('grids.demo.prefix', 'grids-demo'))
        ->middleware(config('grids.demo.middleware', ['web']))
        ->group(function () {
            Route::get('/', [GridsDemoController::class, 'index'])->name('grids.demo');
        });
}
