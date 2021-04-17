<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetsController;
use App\Http\Controllers\SpeciesController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//people related routes
Route::get('people', [PeopleController::class, 'getAllPeople']);
Route::get('people/{id}', [PeopleController::class, 'getPeopleById']);
//planets related routes
Route::get('planets', [PlanetsController::class, 'getAllPlanets']);
Route::get('planets/{id}', [PlanetsController::class, 'getPlanetById']);
//species related routes
Route::get('species', [SpeciesController::class, 'getAllSpecies']);
Route::get('species/{id}', [SpeciesController::class, 'getSpeciesById']);
