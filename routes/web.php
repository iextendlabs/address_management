<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('campaigns', CampaignController::class);
    
    Route::get('/profileDestroy/{id}',[ProfileController::class,'destroy']);
    Route::post('/filter',[ProfileController::class,'filter']);
    Route::get('/sms/{id}',[ProfileController::class,'sms']);
    Route::post('sendSMS',[ProfileController::class,'sendSMS']);
    Route::get('receiveSMS', [ProfileController::class, 'receiveSMS']);
    Route::get('inbox', [ProfileController::class, 'inbox']);

    Route::get('/campaignView/{id}', [CampaignController::class, 'view']);
    Route::get('campaignInbox', [CampaignController::class, 'campaignInbox']);
    Route::get('/campaignChat/{id}',[CampaignController::class,'chat']);
    });


