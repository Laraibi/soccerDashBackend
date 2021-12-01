<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CountrieController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::resource("team", TeamController::class);
route::resource("match", MatchController::class);
route::resource("competition", CompetitionController::class);
route::resource("countrie", CountrieController::class);

route::get("matchsToDay",[MatchController::class,"matchsToDay"])->name("matchsToDay");
