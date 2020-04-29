<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'apartment_id',
        'ip',
        'created_at'
    ];

    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }

    protected $hidden = ['ip', 'updated_at', 'apartment_id'];
}
