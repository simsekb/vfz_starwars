<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Planets;

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
    /*
     * syncs the existing API with the DB
     */
    public function syncAPIPeopleWithDb() {
        $requestResponse = Http::get('https://swapi.dev/api/planets');

        //let's loop through the response we've gotten
        for ($i=1; $i <= $requestResponse['count']; $i++) { //this time the count is 60 and there's no +1 needed:)
            $response = Http::get('https://swapi.dev/api/planets/' . $i);

            //check if the response from the API has resulted in anything but success
            if($response->failed()) {
                //create empty record in db because the API gives an error but we would like to retain the id (auto incrementing)
                Planets::create(
                    array()
                );
                continue;
            }

            //loop through species, extract the ids
            $residents_ids = [];
            if(!empty($response['residents'])) {
                foreach ($response['residents'] as $item) {
                    preg_match_all('!\d+!', $item, $matches);
                    array_push($residents_ids, $matches[0][0]); //the two 0's because preg_match_all creates an Array inside an Array?
                }
            }
            //put all the info that we got into the db
            Planets::create(
                array('name' => $response['name'], 
                'rotation_period' => $response['rotation_period'], 
                'orbital_period' => $response['orbital_period'], 
                'diameter' => $response['diameter'], 
                'climate' => $response['climate'], 
                'gravity' => $response['gravity'], 
                'terrain' => $response['terrain'], 
                'surface_water' => $response['surface_water'], 
                'population' => $response['population'],
                'residents_ids' => json_encode($residents_ids)
                )
            );
        }
    }
}
