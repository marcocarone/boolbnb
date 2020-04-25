<?php

namespace App\Http\Controllers\Api;

use App\View;
use App\Apartment;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function Statistics(Request $request) {
        return response()->json(['message' => "OK"], 200);
    }
}
