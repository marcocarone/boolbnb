<?php
namespace App\Http\Traits;
use App\View;

trait GetViews
{
    function GetViews($apartmentId)
    {
        return View::where('apartment_id', $apartmentId)->count();
    }
}
