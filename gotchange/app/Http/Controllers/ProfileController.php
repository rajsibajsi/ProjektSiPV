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

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = User::where('email', Auth::user()->email)->get()->first();
		$User->lat = $request->input('lat');
		$User->lang = $request->input('lang');

		$User->save();
    }
}
