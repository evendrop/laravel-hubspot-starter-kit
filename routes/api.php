<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HubSpotAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/check', function (Request $request) {
    return \Auth::check() ? 1 : 0;
})->name('user.check.get');

Route::post('/register', [AuthController::class, 'register'])->name('post.register');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum')->name('post.me');

Route::get('/auth-logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('auth.logout');

Route::group(['middleware' => 'auth'], function(){

    Route::resource('portals', PortalController::class);
    Route::resource('teams', TeamController::class);
    Route::post('portals-alias-as', [PortalController::class, 'aliasAs'])->name('portals.alias-as'); 
    Route::post('teams-alias-as', [TeamController::class, 'aliasAs'])->name('teams.alias-as'); 
    Route::get('hubdb/tables', [HubSpotAuthController::class, 'tables'])->name('hubdb-tables.get'); 
    Route::get('hs/lists', [HubSpotAuthController::class, 'lists'])->name('hs-lists.get'); 

});