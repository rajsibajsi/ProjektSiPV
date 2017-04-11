<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use App\Coins;
use Carbon\Carbon;


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
		->where('sender_name', Auth::user()->name)
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

	public function newMessage()
	{
		return view('chat_new');
	}

	public function sendMessage()
	{
		DB::table('chat')->insert(['sender_name' => Auth::User()->name, 'reciever_name' => $_POST['reciever'], 'subject' => $_POST['subject'], 'message' => $_POST['message'], 'sent_at' => Carbon::now()]);

		$chatMessages = DB::table('chat')
		->where('reciever_name', Auth::user()->name)
		->get();

		return view('chat', ['chatMessages' => $chatMessages]);
	}
}
?>