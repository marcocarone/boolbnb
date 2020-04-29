<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
	protected $appends = ['show_route'];

	protected $fillable = [
			'user_id',
			'title',
			'description',
			'n_rooms',
			'n_baths',
			'sq_meters',
			'address',
			'latitude',
			'longitude',
			'cover_img',
			'price',
			'active',
		];

		public function user() {
			return $this->belongsTo('App\User');
		}

		public function services()
	{
		return $this->belongsToMany('App\Service', "apartment_service");
	}

	public function images()
	{
		return $this->hasMany('App\Image');
	}

	public function messages()
	{
		return $this->hasMany('App\Message');
	}

	public function getShowRouteAttribute()
	{
		return route('apartment.show', $this->id);
	}

	public function packages()
	{
	return $this->belongsToMany('App\Package', "apartment_package");
	}

	public function views()
	{
		return $this->hasMany('App\View');
	}
}
