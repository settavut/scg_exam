<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class googleApiController extends BaseController
{
    public function getPlaceData($place){
        $path = storage_path() . "/testing_data.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        return json_decode(file_get_contents($path), true);

        // echo file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$place."&type=restaurant&location=13.0389,101.4901&radius=10000&key=AIzaSyCs41agvvNHRTct5q-YEVwKXvfstVa3Fl4");die();

    }
}

