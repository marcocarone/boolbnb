<?php
namespace App\Http\Traits;

trait CalcDistance
{
	function CalcDistance($lat1, $lon1, $lat2, $lon2)
	{
		if (($lat1 == $lat2) && ($lon1 == $lon2)) {
			return 0;
		} else {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$km = $dist * 60 * 1.85316;
			return $km;
		}
	}
	function DistanceFilter($arrayApartments, $dataLat, $dataLon)
	{
		$apartmentsInRadius = [];
		foreach ($arrayApartments as  $apartment) {
			$km = $this->CalcDistance($dataLat, $dataLon, $apartment->latitude, $apartment->longitude);
			if ($km <= 20) {
				$apartmentsInRadius[] = $apartment;
			}
		}
		return $apartmentsInRadius;
	}
}
