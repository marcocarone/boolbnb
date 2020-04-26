<?php

namespace App\Http\Controllers\Api;

use App\View;
use App\Apartment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller {

	public function Statistics(Request $request) {

		if (!$request->has('apartmentId')) {
			return response()->json(['message' => "Missing apartmentId paramenter!"], 400);
		} elseif (!Apartment::where('id', $request['apartmentId'])->exists()) {
			return response()->json(['message' => "Apartment ID not found!"], 400);
		}

		if (!$request->has('startDate') || !$request->has('endDate')) {
			return response()->json(['message' => "Missing startDate or endDate paramenter!"], 400);
		}

		try {
			$start = Carbon::createFromFormat('d/m/Y', $request['startDate'])->format('Y-m-d 00:00:00');
		} catch (\Exception $e) {
			return response()->json(['message' => "Parameter startDate not valid!"], 400);
		}

		try {
			$end = Carbon::createFromFormat('d/m/Y', $request['endDate'])->format('Y-m-d 23:59:59');
		} catch (\Exception $e) {
			return response()->json(['message' => "Parameter endDate not valid!"], 400);
		}

		$views = View::where('apartment_id', $request['apartmentId'])->get();

		$viewsFiltered = [];
		foreach ($views as $view) {
			if (Carbon::parse($view->created_at)->lt($end) && Carbon::parse($view->created_at)->gt($start)) {
				$viewsFiltered[] = explode(' ', $view['created_at'])[0];
			}
		}

		$data = array_count_values($viewsFiltered);

		return response()->json([$data], 200);
	}

}
