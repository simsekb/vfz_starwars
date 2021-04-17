<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlanetsController extends Controller
{
    /* 
     * get all planets
     */
    public function getAllPlanets()
    {
        return Http::get('https://swapi.dev/api/planets')->json();
    }
    /* 
     * get planet by id
     */
    public function getPlanetById($id) {
        return Http::get('https://swapi.dev/api/planets/' . $id)->json();
    }
}
