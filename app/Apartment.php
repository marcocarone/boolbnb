<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
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
}
