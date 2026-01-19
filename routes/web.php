<?php

use Accelade\Tables\Http\Controllers\TablesDemoController;
use Illuminate\Support\Facades\Route;

// Demo routes (only in development)
if (config('tables.demo.enabled', false)) {
    Route::prefix(config('tables.demo.prefix', 'tables-demo'))
        ->middleware(config('tables.demo.middleware', ['web']))
        ->group(function () {
            Route::get('/', [TablesDemoController::class, 'index'])->name('tables.demo');
            Route::post('/users', [TablesDemoController::class, 'create'])->name('tables.demo.users.create');
            Route::put('/users/{user}', [TablesDemoController::class, 'update'])->name('tables.demo.users.update');
            Route::delete('/users/{user}', [TablesDemoController::class, 'destroy'])->name('tables.demo.users.destroy');
            Route::post('/users/bulk-delete', [TablesDemoController::class, 'bulkDelete'])->name('tables.demo.users.bulk-delete');
            Route::post('/users/export', [TablesDemoController::class, 'export'])->name('tables.demo.users.export');
        });
}
