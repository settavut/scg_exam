<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use File;
use Illuminate\Support\Facades\Storage;


class googleApiController extends BaseController
{
    public function getPlaceData($place){
        // cache using day by day
        $place = urlencode($place);
        $date = date('d-m-Y');
        $path = "\/cache\/search_results\/".$date.".json"; 
        $googleApi = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$place."&type=restaurant&location=13.0389,101.4901&radius=10000&key=AIzaSyCs41agvvNHRTct5q-YEVwKXvfstVa3Fl4";
        if(Storage::disk('public')->exists($path)){
            // if cache is exist 
            $cacheData = json_decode(Storage::disk('public')->get($path));
            if(isset($cacheData->$place)){
                return response()->json($cacheData->$place);
            }else{
                // put new data to cache file
                $data = file_get_contents($googleApi);
                $data = json_decode($data);
                $cacheData->$place = $data->results;
                // File::put($path,json_encode($cacheData));
                Storage::disk('public')->put($path,json_encode($cacheData));
                return response()->json($cacheData->$place);
            }
        }else{
            // if cache not exist 
            $data = file_get_contents($googleApi);
            $data = json_decode($data);
            $dataArray = [];
            $dataArray[$place] = $data->results;
            Storage::disk('public')->put($path,json_encode($dataArray));
            return response()->json($dataArray[$place]);
        }
    }
}

