<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Image;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        $apartments = Apartment::where('active', '1')->get();
        $apartmentsInRadius = [];
        foreach ($apartments as  $apartment) {
            $km = distance($data["latitude"], $data["longitude"], $apartment->latitude, $apartment->longitude);
            if ($km <= 20) {
                $apartmentsInRadius[] = $apartment;
            }
        }
        $services = Service::all();
        $data =[
      "address" => $data["address"],
      "apartmentsInRadius" => $apartmentsInRadius,
      "centerLatitude" => $data["latitude"],
      "centerLongitude" => $data["longitude"],
      "services" => $services
    ];

        return view('search', $data);
    }
}


function distance($lat1, $lon1, $lat2, $lon2)
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $km = $dist * 60 * 1.85316;
        return $km;
    }
}
