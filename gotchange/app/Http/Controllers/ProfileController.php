<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index() {
    	return view("profile");
    }

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = User::where('email', Auth::user()->email);
	    echo $User;
		/*$User->lat = $request->input('lat');
		$User->lng = $request->input('lng');

		$User->save();*/
    }
}
