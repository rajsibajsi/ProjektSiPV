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

    public function saveLocation() {
    	if(Request::ajax()) {
	      	$data = Input::all();
	      	print_r($data);die;

	      	$User = App\User::where('email', Auth::user()->email);
			$User->lat = $data['lat'];
			$User->lng = $data['lng'];

			$User->save();
	    }
	    else {
	    	echo "Nope.";
	    }
    }
}
