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
            $distance = rad2deg(acos((sin(deg2rad(Auth::user()->lat))*sin(deg2rad($users[$i]->lat))) + (cos(deg2rad(Auth::user()->lat))*cos(deg2rad($users[$i]->lat))*cos(deg2rad(Auth::user()->lang-$users[$i]->long)))));
            $users[$i]->distanceToMe = $distance * 111.13384;
        }

        $sorted = $users->sortBy('distanceToMe');

        return view('home', ['users' => $users]);
    }
}

//$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));