<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$apartments = Apartment::where('active', '1')->get();
		return view('home', compact('apartments'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Apartment  $apartment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Apartment $apartment)
	{
		if (empty($apartment)) {
			abort('404');
		}
		// $apartment->views += 1;
		// $apartment->update();
		return view('show', compact('apartment'));
	}
}