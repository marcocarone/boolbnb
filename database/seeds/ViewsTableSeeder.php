<?php

use Illuminate\Database\Seeder;
use App\View;
use App\Apartment;
use Carbon\Carbon;
use Faker\Generator as Faker;

class ViewsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(Faker $faker)
	{
		for ($i=0; $i < 1000; $i++) {
			$view = new View;

			$view->apartment_id = Apartment::inRandomOrder()->first()->id;
			$view->created_at = Carbon::now()->subMinutes(rand(1, 45000));
			$view->ip = $faker->ipv4;
			$view->save();
		}
	}
}
