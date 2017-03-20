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

    public function dbAllCoins(){
    	$coins = DB::select('select * from coins');

    	@foreach($coins as $coin)
    		<div class="col-sm-12">
    			<div>{{ $coin->name }}</div>
    			<div>{{ $coin->weight }}</div>
    		</div>
    	@empty
    		<h2>No coins in database</h2>
    	@endforelse
    }
}
