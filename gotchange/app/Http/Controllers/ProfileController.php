<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

class ProfileController extends Controller
{
    public function index() {
    	return view("profile");
    }

    public function others($id) {
        $User = User::where('id', $id)->get()->first();
        return view("others", ['name' => $User->name, 'email' => $User->email, 'date' => $User->created_at, 'lat' => $User->lat]);
    }

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = User::where('email', Auth::user()->email)->get()->first();
		$User->lat = $request->input('lat');
		$User->lang = $request->input('lang');

		$User->save();

		return redirect('/profile');
    }

    public function seeLocation() {
    	$User = User::where('email', Auth::user()->email)->get()->first();
    	$lat = $User->lat;
    	$lang = $User->lang;
    	return view("locationShower", compact('lat', 'lang'));
    }
}
