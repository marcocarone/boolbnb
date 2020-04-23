<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Package;
use App\ApartmentPackage;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ApartmentsPackagesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(Faker $faker)
	{
		$apartments = Apartment::inRandomOrder()->get();

		for ($i=0; $i < 7; $i++) { 
			$sponsor = new ApartmentPackage;
			$sponsor->apartment_id = $apartments[$i]['id'];
			$sponsor->package_id = Package::inRandomOrder()->first()->id;
			$sponsor->start = Carbon::now()->subMinutes(rand(1, 4320));
			$sponsor->end = $sponsor->start->addHours(Package::find($sponsor->package_id)->duration);
			$sponsor->created_at = $sponsor->start;
			$sponsor->transaction_id = $faker->password;
			$sponsor->save();
		}
		
	}
}
