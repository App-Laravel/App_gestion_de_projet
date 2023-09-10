<?php 

use Illuminate\Support\Facades\Route;
use Modules\Project\src\Http\Controllers\ProjectController;

// all routes for Project module of the authenticated user
Route::prefix('user')->middleware('web')->name('user.')->group(function(){
    Route::prefix('projects')->name('projects.')->group(function(){

        // show all projects of the user
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        
        // show details of selected project
        Route::get('/detail/{id?}', [ProjectController::class, 'detail'])->name('detail');

        // create a new project
        Route::get('/add', [ProjectController::class, 'add'])->name('add');
        Route::post('/add', [ProjectController::class, 'postAdd'])->name('postAdd');

        // update a project
        Route::get('/edit/{id?}', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/edit', [ProjectController::class, 'postEdit'])->name('postEdit');

        // delete a project
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');

        // Accept the invitation
        Route::get('/invitation/accept/{id}/{hash}', [ProjectController::class, 'acceptInvitation'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('accept-invitation');
    });
    
});