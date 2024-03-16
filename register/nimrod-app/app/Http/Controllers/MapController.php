<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MapController extends Controller
{
    public function showMap()
    {
        return view('map');
    }

    public function getMap(Request $request)
    {
        $latitude = $request->input('lat');
        $longitude = $request->input('lng');

        // Make API request to OpenStreetMap
        $client = new Client();
        $response = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse?format=json&lat='.$latitude.'&lon='.$longitude.'&zoom=18&addressdetails=1');

        $mapData = json_decode($response->getBody());

        return $mapData;
    }
}
