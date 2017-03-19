<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
    	return view("profile");
    }

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = App\User::where('email', Auth::user()->email);
		$User->lat = $request->input('lat');
		$User->lng = $request->input('lng');

		$User->save();
    }
}
