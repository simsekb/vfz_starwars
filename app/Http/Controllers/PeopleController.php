<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeopleController extends Controller
{
    /* 
     * get all people
     */
    public function getAllPeople()
    {
        return Http::get('https://swapi.dev/api/people')->json();
    }
    /* 
     * get all people by id
     */
    public function getPeopleById($id) {
        return Http::get('https://swapi.dev/api/people/' . $id)->json();
    }
}
