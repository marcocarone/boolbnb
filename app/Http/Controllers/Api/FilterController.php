<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\ApartmentPackage;
use App\Service;
use Carbon\Carbon;
use App\Http\Traits\CalcDistance;

class FilterController extends Controller
{
	use CalcDistance;

	public function Filter(Request $request)
	{

		if (!$request->has('centerLongLat') || count($request['centerLongLat']) != 2) {
			return response()->json(['message' => "Missing or invalid centerLongLat paramenter!",], 400);
		}

		if (!$request->has('distance')) {
			return response()->json(['message' => "Missing distance paramenter!"], 400);
		} else if ($request['distance'] < 20 || $request['distance'] > 100) {
			return response()->json(['message' => "Distance paramenter not valid!"], 400);
		}

		if (!$request->has('baths')) {
			return response()->json(['message' => "Missing baths paramenter!"], 400);
		} else if ($request['baths'] < 1 || $request['baths'] > 3) {
			return response()->json(['message' => "Baths paramenter not valid!"], 400);
		}

		if (!$request->has('rooms')) {
			return response()->json(['message' => "Missing rooms paramenter!"], 400);
		} else if ($request['rooms'] < 1 || $request['rooms'] > 12) {
			return response()->json(['message' => "Rooms paramenter not valid!"], 400);
		}

		$apartamentsFiltered = Apartment::where('active', '1');

		if ($request->has('services')) {
			$services = $request['services'];
			$apartamentsFiltered = $apartamentsFiltered->whereHas('services', function ($query) use ($services) {
				$query->whereIn('services.id', $services);
			}, '=', count($services));
		}

		$distance = $request['distance'];
		$apartmentsInRadius = [];
		foreach ($apartamentsFiltered->get() as $apartment) {
			$km = $this->CalcDistance($request['centerLongLat'][1], $request['centerLongLat'][0], $apartment->latitude, $apartment->longitude);
			if ($km <= $distance) {
				$apartmentsInRadius[] = $apartment;
			}
		}

		$apartamentsFiltered = $apartmentsInRadius;

		if ($request->has('rooms')) {
			$apartmentsRooms = [];
			$rooms = $request['rooms'];
			foreach ($apartamentsFiltered as $apartment) {
				if ($apartment->n_rooms >= $rooms) {
					$apartmentsRooms[] = $apartment;
				}
			}
		}

		$apartamentsFiltered = $apartmentsRooms;

		if ($request->has('baths')) {
			$apartmentsBaths = [];
			$baths = $request['baths'];
			foreach ($apartamentsFiltered as $apartment) {
				if ($apartment->n_baths >= $baths) {
					$apartmentsBaths[] = $apartment;
				}
			}
		}

		$apartamentsFiltered = $apartmentsBaths;

		$allApartmentPackage = ApartmentPackage::all();
		$sponsoredApartments = [];
		foreach ($allApartmentPackage as $apartmentpkg) {
			if (Carbon::parse($apartmentpkg->start)->lt(Carbon::now()) && Carbon::parse($apartmentpkg->end)->gt(Carbon::now())) {
				$sponsoredApartments[] = $apartmentpkg->apartment_id;
			}
		}

		foreach ($apartamentsFiltered as $apartamentFiltered) {
			if (in_array($apartamentFiltered["id"], $sponsoredApartments )) {
				$apartamentFiltered["sponsored"] = true;
			}
		}

		return response()->json([
			'results' => $apartamentsFiltered,
			], 200);
	}
}
