<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Http\Traits\CalcDistance;

class FilterController extends Controller
{
	use CalcDistance;

	public function Filter(Request $request)
	{
		if (!$request->has('centerLongLat') || count($request['centerLongLat']) < 2) {
			return response()->json([
				'message' => "Missing paramenter!",
				], 400);
		}

		if ($request->has('services') && count($request['services']) > 0) {
			$services = $request['services'];
			$apartamentsFiltered = Apartment::whereHas('services', function ($query) use ($services) {
				$query->whereIn('services.id', $services);
			}, '=', count($services))->get();
		}

		if (!isset($apartamentsFiltered)) {
			$apartamentsFiltered = Apartment::where('active', '1')->get();
		}

		$apartmentsInRadius = [];
		foreach ($apartamentsFiltered as $apartment) {
			$km = $this->CalcDistance($request['centerLongLat'][1], $request['centerLongLat'][0], $apartment->latitude, $apartment->longitude);
			if ($km <= 20) {
				$apartmentsInRadius[] = $apartment;
			}
		}

		return response()->json([
			'results' => $apartmentsInRadius,
			], 200);
	}
}