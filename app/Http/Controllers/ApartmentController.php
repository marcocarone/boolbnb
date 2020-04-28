<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentPackage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\View;


class ApartmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$sponsoredApartments = [];
		$allApartmentPackage = ApartmentPackage::all();
		foreach ($allApartmentPackage as $apartmentpkg) {
			if (Carbon::parse($apartmentpkg->start)->lt(Carbon::now()) && Carbon::parse($apartmentpkg->end)->gt(Carbon::now())) {
				$sponsoredApartments[] = $apartmentpkg->apartment_id;
			}
		}
		$advApt = Apartment::where('active', '1')->whereIn('id', $sponsoredApartments)->latest()->get();
		$noAdvApt = Apartment::where('active', '1')->whereNotIn('id', $sponsoredApartments)->latest()->get();
		$data = ['advApt' => $advApt, 'noAdvApt' => $noAdvApt];
		return view('home', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Apartment  $apartment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Apartment $apartment, Request $request)
	{
		if (empty($apartment)) {
			abort('400');
		}
		$searchIp = View::where('ip', $request->ip())->latest()->first();
		if (empty($searchIp) || Carbon::parse($searchIp->created_at)->lt(Carbon::now()->subMinutes(10))) {
			$view = new View;
			$view->apartment_id = $apartment->id;
			$view->ip = $request->ip();
			$view->save();
		}
			return view('show', compact('apartment'));
	}
}
