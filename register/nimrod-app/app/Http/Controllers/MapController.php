<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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

    // OpenCage API key
    $apiKey = "f815d28a595d4ef08ab03f09b352242a"; // Store your API key in the .env file

    // Create a new Guzzle client
    $client = new Client();

    try {
        $response = $client->request('GET', 'https://api.opencagedata.com/geocode/v1/json', [
            'query' => [
                'key' => $apiKey,
                'q' => "{$latitude},{$longitude}",
                'pretty' => 1,
                'no_annotations' => 1
            ]
        ]);

        $mapData = json_decode($response->getBody());

        // Check if there are results
        if (isset($mapData->results[0])) {
            $mapData = $mapData->results[0];
        } else {
            return response()->json([
                'error' => 'No results found.'
            ], 404);
        }

    } catch (RequestException $e) {
        // Handle the error gracefully
        return response()->json([
            'error' => 'Unable to fetch map data.',
            'message' => $e->getMessage()
        ], 500);
    }

    $mapData->crashwatch_city = env('CRASHWATCH_CITY');

    return response()->json($mapData);
}
}
