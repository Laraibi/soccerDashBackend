<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\authController;
use App\Http\Controllers\PronoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\importJsonController;
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

Route::post("signup", [authController::class, "register"]);
Route::post("signin", [authController::class, "login"]);



// import json File
route::post("/importJson", [importJsonController::class, "importMatchs"]);
route::get("/getAvailableJsonFiles", [importJsonController::class, "getAvailableFiles"]);



// route::resource("team", TeamController::class);
// route::resource("match", MatchController::class);
// route::resource("competition", CompetitionController::class);
// route::resource("countrie", CountrieController::class);
route::get("matchsToDay", [MatchController::class, "matchsToDay"])->name("matchsToDay");
route::post("matchsInDay", [MatchController::class, "matchsInDay"])->name("matchsInDay");
route::middleware('auth:sanctum')->group(function () {
    Route::get("logout", [authController::class, "logout"]);
    route::resource("Prono", PronoController::class);
});
