<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        for ($i=0; $i < count($users) - 1; $i++) { 
            $users[$i]->distanceToMe = getDistanceBetweenPointsNew(Auth::user()->lat, Auth::user()->lang, $users[$i]->lat, $users[$i]->lang, $unit = 'Km');
        }

        asort($users);

        return view('home', ['users' => $users]);
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515; switch($unit) {
            case 'Mi': break; case 'Km' : $distance = $distance * 1.609344;
        }
        return (round($distance,2));
    }
}
