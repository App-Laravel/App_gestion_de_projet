<?php 

use Illuminate\Support\Facades\Route;
use Modules\Project\src\Http\Controllers\ProjectController;

Route::prefix('user')->middleware('web')->name('user.')->group(function(){
    Route::prefix('projects')->name('projects.')->group(function(){
        Route::get('/', [ProjectController::class, 'index'])->name('index');
    });
    
});