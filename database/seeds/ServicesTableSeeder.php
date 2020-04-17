<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$services = [
			'WiFi',
			'TV',
			'Lavatrice',
			'Posto Auto',
			'Vista Mare',
			'Portineria',
			'Cassaforte',
			'Servizio Navetta',
			'Kit Cortesia',
			'Aria Condizionata',
			'Piscina',
			'Riscaldamento'
		];

		for ($i=0; $i < count($services); $i++) { 
			$service = new Service;
			$service->title = $services[$i];
			$service->save();
		}
	}
}
