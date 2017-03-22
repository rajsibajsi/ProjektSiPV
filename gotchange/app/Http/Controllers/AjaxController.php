<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
