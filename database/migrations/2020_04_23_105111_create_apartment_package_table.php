<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentPackageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apartment_package', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('apartment_id');
			$table->foreign('apartment_id')
				->references('id')
				->on('apartments');

			$table->unsignedBigInteger('package_id');
			$table->foreign('package_id')
				->references('id')
				->on('packages');

			$table->datetime('start');
			$table->datetime('end');
			$table->timestamps();
			$table->char('transaction_id');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('apartment_package');
	}
}
