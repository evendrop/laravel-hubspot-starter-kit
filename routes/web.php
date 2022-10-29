<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubSpotAuthController;


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

Route::get('/hs-auth', [HubSpotAuthController::class, 'authTrigger']);

Route::get('/submitauth', [HubSpotAuthController::class, 'authResponse']);



Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');