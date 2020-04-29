<?php

use Illuminate\Database\Seeder;
use App\Package;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $packages = [
        'name' => ['Silver', 'Gold', 'Platinum'],
        'price' => [002.99, 005.99, 009.99],
        'duration' => [24, 72, 144],
      ];
      for ($i = 0; $i < count($packages['name']); $i++) {
        $package = new Package();
        $package->name = $packages['name'][$i];
        $package->price = $packages['price'][$i];
        $package->duration = $packages['duration'][$i];
        $package->save();
      }
    }
}
