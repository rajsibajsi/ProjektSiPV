<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use App\Coins;

class AjaxController extends Controller
{
	public function index(){
		if(!(Session::has('albumEditing')))	
		{
			Session::put('albumEditing', 'true');
			return response('Album editing is <kbd>enabled</kbd>');
		}	
		else if(Session::get('albumEditing') === 'false')
		{
			Session::put('albumEditing', 'true');
			return response('Album editing is <kbd>enabled</kbd>');
		}
		else if(Session::get('albumEditing') === 'true')
		{
			Session::put('albumEditing', 'false');
			return response('Album editing is <kbd>disabled</kbd>');
		}
		else
		{
			return response('something went wrong!');
		}
	}

	public function getAlbumSessionVariable()
	{
		return response(Session::get('albumEditing'));
	}

	public function settingOwnership()
	{
		$User = User::where('id', Auth::user()->id)->get()->first();
		$coinID = Coins::where('description', $_GET['data'])->get()->first();

		if(DB::table('users_coins')
			->where('id_user', $User->id)
			->where('id_coin', $coinID->id)->exists())
		{	//Delete data in DB if it exists
			DB::table('users_coins')
				->where('id_user', $User->id)
				->where('id_coin', $coinID->id)->delete();
		}
		else //Insert if there is no such data in DB
		{
			DB::table('users_coins')
			->insert(['id_user'=> $User->id, 'id_coin'=> $coinID->id]);
		}
	}
}