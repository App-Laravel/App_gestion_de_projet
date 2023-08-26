<?php

use Illuminate\Support\Facades\Route;
use Modules\Task\src\Http\Controllers\TaskController;

Route::prefix('user')->middleware('web')->name('user.')->group(function(){
    Route::prefix('tasks')->name('tasks.')->group(function(){
        Route::get('/', [TaskController::class, 'index'])->name('index');
    });
    
});