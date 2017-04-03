<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use App\Coins;


class ChatController extends Controller
{
	public function index()
	{
		$chatMessages = DB::table('chat')
		->where('reciever_name', Auth::user()->name)
		->get();

		return view('chat', ['chatMessages' => $chatMessages]);
	}

	public function sent()
	{
		$chatMessages = DB::table('chat')
		->where('reciever_name', Auth::user()->name)
		->get();

		return view('chat_sent_items', ['chatMessages' => $chatMessages]);
	}

	public function inbox()
	{
		$chatMessages = DB::table('chat')
		->where('reciever_name', Auth::user()->name)
		->get();

		return view('chat_inbox', ['chatMessages' => $chatMessages]);
	}
}

?>