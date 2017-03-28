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
            $theta = Auth::user()->lang - $users[$i]->lang;
            $distance = (sin(deg2rad(Auth::user()->lat)) * sin(deg2rad($users[$i]->lat))) + (cos(deg2rad(Auth::user()->lat)) * cos(deg2rad($users[$i]->lat)) * cos(deg2rad($theta)));
            $distance = acos($distance);
            $distance = rad2deg($distance);
            $distance = $distance * 60 * 1.1515;
            $users[$i]->distanceToMe = $distance * 1.609344;
        }

        return view('home', ['users' => $users]);
    }
}
