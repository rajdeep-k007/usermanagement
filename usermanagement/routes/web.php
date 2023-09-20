<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;


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
// Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/', function () {
    // Log::info(Auth::user());
     $clientIp = \Request::ip();
    Log::channel('customlog')->info("User with ip: ".$clientIp." logged in !");
    return redirect('/login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//email
// Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
// Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');


// Pages
    Route::group(['middleware'=>'auth'], function(){

        //users
        Route::get('/userslist', [App\Http\Controllers\UsersController::class, 'show'])->name('userslist')->middleware('log.route');
        Route::get('/createUserPage', [App\Http\Controllers\UsersController::class, 'createUserPage'])->name('createUserPage');
        Route::post('/createUser', [App\Http\Controllers\UsersController::class, 'createUser'])->name('createUser');
        Route::get('/removeUser/{id}', [App\Http\Controllers\UsersController::class, 'remove'])->name('usersRemove');
        Route::get('/viewUser/{id}', [App\Http\Controllers\UsersController::class, 'view'])->name('viewUser');
        Route::get('/restoreUser/{id}', [App\Http\Controllers\UsersController::class, 'restore'])->name('restoreUser');

        //permissions
        Route::get('/permissionslist', [App\Http\Controllers\PermissionController::class, 'show'])->name('permissionslist')->middleware('log.route');
        Route::get('/removePermission/{id}', [App\Http\Controllers\PermissionController::class, 'remove'])->name('permissionsRemove');
        Route::get('/createRolePage', [App\Http\Controllers\PermissionController::class, 'createPage'])->name('createRolePage');
        Route::post('/addRole', [App\Http\Controllers\PermissionController::class, 'create'])->name('createRolePage');

        //activity
        Route::get('/activitylist', [App\Http\Controllers\ActivityController::class, 'show'])->name('activitylist')->middleware('log.route');
        Route::get('/activity/{id}', [App\Http\Controllers\ActivityController::class, 'remove'])->name('activityRemove');
        Route::get('/removeActivityLog/{id}', [App\Http\Controllers\ActivityController::class, 'remove'])->name('activityRemove');
        Route::get('/restoreActivity/{id}', [App\Http\Controllers\ActivityController::class, 'restore'])->name('restoreActivity');

        //blocked Items
        Route::get('/blockedItemslist', [App\Http\Controllers\BlockedItemsController::class, 'show'])->name('blockedItemslist')->middleware('log.route');
        Route::get('/createBlockedItemPage', [App\Http\Controllers\BlockedItemsController::class, 'createPage'])->name('createBlockedItemPage');
        Route::post('/addItemToBlock', [App\Http\Controllers\BlockedItemsController::class, 'create'])->name('addItemToBlock');
        Route::get('/removeBlockedItem/{id}', [App\Http\Controllers\BlockedItemsController::class, 'remove'])->name('blockedItemRemove');
        Route::get('/restoreBlockedItem/{id}', [App\Http\Controllers\BlockedItemsController::class, 'restore'])->name('blockedItemRestore');

        // Profile
        Route::get('/userProfile', function(){ return view('userProfile'); })->name('profile');
        Route::get('/editProfile', function(){ return view('editProfile'); })->name('editProfile');
        Route::patch('/userprofileEdit/{id}', [App\Http\Controllers\UsersController::class, 'submitEditForm'])->name('userprofile.form.submit');


    });
// ----------------------------Authentication section----------------------------
    // GITHUB
    // send the user back from github to authenticate user
    Route::get('/auth/github/redirect', [App\Http\Controllers\Auth\LoginController::class,'githubRedirect'])->name('github.redirect');

    // get oauth request back from github to authenticate user
    Route::get('/auth/github/callback', [App\Http\Controllers\Auth\LoginController::class,'githubCallback'])->name('github.callback');



    // GOOGLE
    // send the user back from google to authenticate user
    Route::get('/auth/google/redirect', [App\Http\Controllers\Auth\LoginController::class,'googleRedirect'])->name('google.redirect');

    // get oauth request back from google to authenticate user
    Route::get('/auth/google/callback', [App\Http\Controllers\Auth\LoginController::class,'googleCallback'])->name('google.callback');



    // FACEBOOK
    // send the user back from facebook to authenticate user
    Route::get('/auth/facebook/redirect', [App\Http\Controllers\Auth\LoginController::class,'facebookRedirect'])->name('facebook.redirect');

    // get oauth request back from facebook to authenticate user
    Route::get('/auth/facebook/callback', [App\Http\Controllers\Auth\LoginController::class,'facebookCallback'])->name('facebook.callback');


//  admin

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/users',[AdminController::class, 'usersList'])->name('admin.users');
    // Route::get('/users', function(){ return view('users'); });
    Route::get('/users/{id}',[AdminController::class, 'showDetail'])->name('admin.user.detail');
    Route::post('/users/update/{id}',[AdminController::class, 'update'])->name('admin.user.update');
    Route::put('/users/remove/{id}',[AdminController::class, 'remove'])->name('admin.user.remove');
    Route::delete('/users/destroy/{id}',[AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/users',[AdminController::class, 'adminGetAllUsers'])->name('admin.users');
});

//  user


// block
    Route::group(['middleware'=>'is-ban'], function(){

        // home page
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // block & unblock
        Route::post('userBan', [App\Http\Controllers\UsersController::class, 'ban'])->name('users.ban');
        Route::get('userRevoke/{id}', [App\Http\Controllers\UsersController::class, 'revoke'])->name('users.revokeUser');
    });


