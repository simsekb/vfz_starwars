<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpeciesController extends Controller
{
    /* 
     * get all species
     */
    public function getAllSpecies()
    {
        return Http::get('https://swapi.dev/api/species')->json();
    }
    /* 
     * get species by id
     */
    public function getSpeciesById($id) {
        return Http::get('https://swapi.dev/api/species/' . $id)->json();
    } 
}
