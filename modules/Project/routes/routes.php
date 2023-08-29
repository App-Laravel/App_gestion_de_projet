<?php 

use Illuminate\Support\Facades\Route;
use Modules\Project\src\Http\Controllers\ProjectController;

Route::prefix('user')->middleware('web')->name('user.')->group(function(){
    Route::prefix('projects')->name('projects.')->group(function(){

        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/detail/{id?}', [ProjectController::class, 'detail'])->name('detail');

        Route::get('/add', [ProjectController::class, 'add'])->name('add');
        Route::post('/add', [ProjectController::class, 'postAdd'])->name('postAdd');

        Route::get('/edit/{id?}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/edit', [ProjectController::class, 'postEdit'])->name('postEdit');

        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');
    });
    
});