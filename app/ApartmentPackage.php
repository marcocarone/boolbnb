<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentPackage extends Model
{
	protected $fillable = [
		'apartment_id',
		'package_id',
		'start',
		'end',
		'created_at',
		'transaction_id',
	];

	protected $table = 'apartment_package';
}
