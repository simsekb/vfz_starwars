<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Species;

class SpeciesController extends Controller
{
    /* 
     * get all species
     */
    public function getAllSpecies()
    {
        return Species::all();
    }
    /* 
     * get species by id
     */
    public function getSpeciesById($id) {
        return Species::where('id', '=', $id);
    }
    /*
     * syncs the existing API with the DB
     */
    public function syncAPIPeopleWithDb() {
        $requestResponse = Http::get('https://swapi.dev/api/species');

        //let's loop through the response we've gotten
        for ($i=1; $i <= $requestResponse['count']; $i++) {
            $response = Http::get('https://swapi.dev/api/species/' . $i);

            //check if the response from the API has resulted in anything but success
            if($response->failed()) {
                //create empty record in db because the API gives an error but we would like to retain the id (auto incrementing)
                Species::create(
                    array()
                );
                continue;
            }
            //get planet, extract the id
            $planet_id = '';
            if($response['homeworld'] != null && $response['homeworld'] != 'unknown') { //let's check for valid integers before doing something, because some of the values we get back are not integers
                preg_match_all('!\d+!', $response['homeworld'], $matches);
                $planet_id = $matches[0][0];
            }
            else {
                $planet_id = null;
            }

            //loop through species, extract the ids
            $people_ids = [];
            if(!empty($response['people'])) {
                foreach ($response['people'] as $item) {
                    preg_match_all('!\d+!', $item, $matches);
                    array_push($people_ids, $matches[0][0]); //the two 0's because preg_match_all creates an Array inside an Array?
                }
            }
            //put all the info that we got into the db
            Species::create(
                array('name' => $response['name'], 
                'classification' => $response['classification'], 
                'designation' => $response['designation'], 
                'average_height' => $response['average_height'], 
                'skin_colors' => $response['skin_colors'], 
                'hair_colors' => $response['hair_colors'], 
                'eye_colors' => $response['eye_colors'], 
                'average_lifespan' => $response['average_lifespan'], 
                'planet_id' => $planet_id,
                'language' => $response['language'], 
                'people_ids' => json_encode($people_ids)
                )
            );
        }
    }
}
