<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'apartment_id',
        'created_at'
    ];

	public function apartment() {
		return $this->belongsTo('App\Apartment');
	}
}
