<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class FilterController extends Controller
{
	public function Filter(Request $request)
	{
		if ($request->has('services') && count($request['services']) > 0) {
			$services = $request['services'];
			$apartamentsFiltered = Apartment::whereHas('services', function ($query) use ($services) {
				$query->whereIn('services.id', $services);
			}, '=', count($services))->get();
		}
		
		return response()->json([
			'results' => isset($apartamentsFiltered) ? $apartamentsFiltered : Apartment::all(),
			], 200);
	}
}

