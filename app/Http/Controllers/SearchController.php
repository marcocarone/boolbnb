<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\ApartmentPackage;
use Carbon\Carbon;
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
			$sponsoredApartments = [];
			$allApartmentPackage = ApartmentPackage::all();
			foreach ($allApartmentPackage as $apartmentpkg) {
				if (Carbon::parse($apartmentpkg->start)->lt(Carbon::now()) && Carbon::parse($apartmentpkg->end)->gt(Carbon::now())) {
					$sponsoredApartments[] = $apartmentpkg->apartment_id;
				}
			}
			$advApt = Apartment::where('active', '1')->whereIn('id', $sponsoredApartments)->latest()->get();
			$noAdvApt = Apartment::where('active', '1')->whereNotIn('id', $sponsoredApartments)->latest()->get();

			$apartmentsInRadius = $this->DistanceFilter($noAdvApt, $data["latitude"], $data["longitude"]);
			$advApt = $this->DistanceFilter($advApt, $data["latitude"], $data["longitude"]);
			$services = Service::all();
			$data =[
				"address" => $data["address"],
				"apartmentsInRadius" => $apartmentsInRadius,
				"sponsoredApartments" => $advApt,
				"centerLatitude" => $data["latitude"],
				"centerLongitude" => $data["longitude"],
				"services" => $services
			];
			return view('search', $data);
		}
	}
