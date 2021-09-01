<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['middleware'=>['auth','auth']], function (){
    
    Route::get('/', [App\Http\Controllers\DeshbordHomeController::class, "index"]);
    Route::get('/profile', function () {
        return view('templates.profile');
    });
    

    Route::get('/designs/templates', [App\Http\Controllers\DesignViewController::class, "allTemplates"]);
    Route::get('/designs/my-templates', [App\Http\Controllers\DesignViewController::class, "myTemplates"]);
    Route::resource('designs', App\Http\Controllers\DesignController::class);
    Route::get('/favorite/{id}',[ App\Http\Controllers\DesignController::class,"makeFavorite"]);
    Route::get('/my-favorite',[ App\Http\Controllers\DesignController::class,"getMyFavorite"]);
    Route::get('/s',[App\Http\Controllers\DesignViewController::class,"getSearch"]);
    Route::get('design/user/{id}',[App\Http\Controllers\DesignViewController::class,"getDesignForUser"]);
    
    Route::post('/profile-info-udate', [App\Http\Controllers\UserController::class,"profile"]);
    Route::post('/upload-profile-image', [App\Http\Controllers\UserController::class,"update_avatar"]);
    Route::post('/upload-cover-image', [App\Http\Controllers\UserController::class,"update_cover"]);
    Route::get('/all-user',[App\Http\Controllers\UserController::class,"getAllUsers"]);
    Route::get('/me',function (){
        return view("chat.chat");
    });

    Route::group(['prefix' => 'message'], function () {
        Route::get('user/{query}', [App\Http\Controllers\MessageController::class,'user']);
        Route::get('user-message/{id}', [App\Http\Controllers\MessageController::class,'message']);
        Route::get('user-message/{id}/read', [App\Http\Controllers\MessageController::class,'read']);
        Route::post('user-message', [App\Http\Controllers\MessageController::class,'send']);
    });
    
});

Auth::routes();


