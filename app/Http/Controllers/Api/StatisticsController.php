<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;

use App\View;
use App\Apartment;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller {

	public function Statistics(Request $request) {

		if (!$request->has('apartmentId')) {
			return response()->json(['message' => "Missing apartmentId paramenter!"], 400);
		} elseif (!Apartment::where('id', $request->apartmentId)->exists()) {
			return response()->json(['message' => "Apartment ID not found!"], 400);
		}

		if (!$request->has('startDate') || !$request->has('endDate')) {
			return response()->json(['message' => "Missing startDate or endDate paramenter!"], 400);
		}

		try {
			$from = Carbon::createFromFormat('d/m/Y', $request->startDate)
					->startOfDay()
					->toDateTimeString();
		} catch (\Exception $e) {
			return response()->json(['message' => "Parameter startDate not valid!"], 400);
		}

		try {
			$to = Carbon::createFromFormat('d/m/Y', $request->endDate)
					->endOfDay()
					->toDateTimeString();
		} catch (\Exception $e) {
			return response()->json(['message' => "Parameter endDate not valid!"], 400);
		}

		$views = View::whereBetween('created_at', [$from, $to])
						->where('apartment_id', $request->apartmentId)
						->groupBy('date')
						->get([
							DB::raw('Date(created_at) as date'),
							DB::raw('COUNT(*) as "views"')
						]);

		return response()->json([$views], 200);
	}

}
