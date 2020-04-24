<?php

use Illuminate\Database\Seeder;
use App\View;
use App\Apartment;
use Carbon\Carbon;

class ViewsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i=0; $i < 1000; $i++) { 
			$view = new View;

			$view->apartment_id = Apartment::inRandomOrder()->first()->id;
			$view->created_at = Carbon::now()->subMinutes(rand(1, 10080));
			$view->save();
		}
	}
}
