<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Coins;

class ProfileController extends Controller
{
    public function index() {
    	return view("profile");
    }

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = User::where('email', Auth::user()->email)->get()->first();
		$User->lat = $request->input('lat');
		$User->lang = $request->input('lang');

		$User->save();

		return view("profile");
    }

    public function seeLocation() {
    	$User = User::where('email', Auth::user()->email)->get()->first();
    	$lat = $User->lat;
    	$lang = $User->lang;
    	return view("locationShower", compact('lat', 'lang'));
    }

    public function dbAllCoins() {

        $coins = DB::select('select * from coins');
      //  $coins->save();

        return view("allCoins", ['coins' => $coins]);
    }
}
