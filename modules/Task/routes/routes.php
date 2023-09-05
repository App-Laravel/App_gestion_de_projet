<?php

use Illuminate\Support\Facades\Route;
use Modules\Task\src\Http\Controllers\TaskController;
use Modules\Task\src\Http\Controllers\Api\ApiController;

// all routes for Task module of the authenticated user
Route::prefix('user')->middleware('web')->name('user.')->group(function(){
    Route::prefix('tasks')->name('tasks.')->group(function(){

        // show all tasks of the user
        Route::get('/', [TaskController::class, 'index'])->name('index');
        
        // show details of selected task
        Route::get('/detail/{id?}', [TaskController::class, 'detail'])->name('detail');

        // create a new task
        Route::get('/add', [TaskController::class, 'add'])->name('add');
        Route::post('/add', [TaskController::class, 'postAdd'])->name('postAdd');

        // update a task
        Route::get('/edit/{id?}', [TaskController::class, 'edit'])->name('edit');
        Route::put('/edit', [TaskController::class, 'postEdit'])->name('postEdit');

        // delete a task
        Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('delete');

        // delete a task in project
        Route::delete('/delete-in-project/{id}', [TaskController::class, 'delete'])->name('delete-in-project');

    });
    
});


// API
Route::prefix('user')->middleware(['api'])->name('user.')->group(function(){
    Route::prefix('tasks')->name('tasks.')->group(function(){

        // api get project's members
        Route::post('/api', [ApiController::class, 'projectMembers'])->name('api');
    });
    
});

