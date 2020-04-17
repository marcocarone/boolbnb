<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = [
			[
				'name' => 'Nicola',
				'surname' => 'Baglini',
				'email' => 'nicola@email.it',
				'password' => Hash::make('password'),
				'date_of_birth' => Carbon::parse('1989-09-26'),
				'img_profile' => null
			],
			[
				'name' => 'Gianuario',
				'surname' => 'Fiore',
				'email' => 'fiore@email.it',
				'password' => Hash::make('password'),
				'date_of_birth' => Carbon::parse('1989-09-26'),
				'img_profile' => null
			],
			[
				'name' => 'Marco',
				'surname' => 'Carone',
				'email' => 'marco@email.it',
				'password' => Hash::make('password'),
				'date_of_birth' => Carbon::parse('1989-09-26'),
				'img_profile' => null
			],
			[
				'name' => 'Andrea',
				'surname' => 'Pacifico',
				'email' => 'andrea.pacifico@gmail.com',
				'password' => Hash::make('password'),
				'date_of_birth' => Carbon::parse('1990-01-01'),
				'img_profile' => null
			],
			[
				'name' => 'Luisa',
				'surname' => 'Logozzo',
				'email' => 'luisa.log@gmail.com',
				'password' => Hash::make('password'),
				'date_of_birth' => Carbon::parse('1995-01-01'),
				'img_profile' => null
			],
		];
		foreach ($users as $user) {
			$newUser = new User;
			$newUser->name = $user['name'];
			$newUser->surname = $user['surname'];
			$newUser->email = $user['email'];
			$newUser->password = $user['password'];
			$newUser->date_of_birth = $user['date_of_birth'];
			$newUser->img_profile = $user['img_profile'];
			$newUser->save();
		}
	}
}
