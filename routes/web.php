<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\GuestEmailVerificationRequest;
use Carbon\Carbon;

// use UniSharp\LaravelFilemanager\Lfm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Define the homepage routes
Route::get('/', function () {
    return redirect()->action([UserController::class, 'index']);
});
Route::get('/home', function () {
    return redirect()->action([UserController::class, 'index']);
});


// Routes for Authentication - laravel ui
Auth::routes(['verify'=>true]);


// Routes for "user" module
Route::prefix('user')->name('user.')->group(function(){

                            /*********************** authenticated user **********************************/

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('editProfile');
    Route::post('/edit-profile', [UserController::class, 'handleEditProfile'])->name('handleEditProfile');

    Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [UserController::class, 'handleChangePassword'])->name('handleChangePassword');


                            /************************ Guest : email verification *************************/
    
    // Verification of email for user when sign up
    Route::get('/email-verification/{user}', [GuestController::class, 'emailVerification'])
                ->name('email-verification');

    // Resend verification Email
    Route::post('/email-verification-resend/{user}', [GuestController::class, 'emailResend'])
                ->middleware(['throttle:6,1'])
                ->name('email-verification-resend');

    // Set email "verified" when clicking on the link in email
    Route::get('/email/verify/{id}/{hash}', [GuestController::class, 'setEmailVerification'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    // Show the email verification result
    Route::get('/email/verify/result', [GuestController::class, 'verificationResult'])
                ->name('verification-result');
});



/******************************************* File Manager ***********************************************************************/

Route::group(['prefix' => 'avatar-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});