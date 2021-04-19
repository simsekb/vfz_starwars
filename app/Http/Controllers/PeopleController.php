<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\People;

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
    /*
     * syncs the existing API with the DB
     */
    public function syncAPIPeopleWithDb() {
        $requestResponse = Http::get('https://swapi.dev/api/people');

        //let's loop through the response we've gotten
        for ($i=1; $i <= $requestResponse['count']+1; $i++) {
            $response = Http::get('https://swapi.dev/api/people/' . $i);

            //check if the response from the API has resulted in anything but success
            if($response->failed()) {
                //create empty record in db because the API gives an error but we would like to retain the id (auto incrementing)
                People::create(
                    array()
                );
                continue;
            }
            //get planet, extract the id
            preg_match_all('!\d+!', $response['homeworld'], $planet_id);

            //loop through species, extract the ids
            $species_ids = [];
            if(!empty($response['species'])) {
                foreach ($response['species'] as $item) {
                    preg_match_all('!\d+!', $item, $matches);
                    array_push($species_ids, $matches[0][0]); //the two 0's because preg_match_all creates an Array inside an Array?
                }
            }
            //put all the info that we got into the db
            People::create(
                array('name' => $response['name'], 
                'height' => $response['height'], 
                'mass' => $response['mass'], 
                'hair_color' => $response['hair_color'], 
                'skin_color' => $response['skin_color'], 
                'eye_color' => $response['eye_color'], 
                'birth_year' => $response['birth_year'], 
                'gender' => $response['gender'], 
                'planet_id' => $planet_id[0][0], //the two 0's because preg_match_all creates an Array inside an Array?
                'species_ids' => json_encode($species_ids)
                )
            );
        }
    }
}
