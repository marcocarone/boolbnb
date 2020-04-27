<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Image;
use App\Http\Traits\CalcDistance;

class SearchController extends Controller
	{
		use CalcDistance;

		public function index(Request $request)
		{
			if (!$request->has('address') || !$request->has('latitude') || !$request->has('longitude')) {
				return redirect()->route('home');
			}

			$data = $request->all();

			$apartments = Apartment::where('active', '1')->get();
			$apartmentsInRadius = [];
			foreach ($apartments as  $apartment) {
				$km = $this->CalcDistance($data["latitude"], $data["longitude"], $apartment->latitude, $apartment->longitude);
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