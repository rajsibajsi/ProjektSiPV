<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Coins;
use Session;

class ProfileController extends Controller
{
    public function index() {
/*// Za parsanje!
        // pobrisemo bazo
        DB::select('DELETE FROM coins');

        $url = "http://www.coin-database.com/series/eurozone-commemorative-2-euro-coins-2-euro.html";
        $doc = new \DOMDocument();
        @$doc->loadHTMLFile($url);

        $xpath = new \DOMXpath($doc);
        $tabela = $xpath->query('//table[@class="galerka"]');

        // gremo skozi vse kovance v tabeli
        foreach($tabela as $item)
        {
            $kovanci = $item->getElementsByTagName('div');
            $slike = $item->getElementsByTagName('img');
            $zastave = $item->getElementsByTagName('span');
            $header = $item->getElementsByTagName('h3');
            $description = $item->getElementsByTagName('h4');

            $i = 0;
            // gremo skozi vse kovance
            foreach($zastave as $f)
            {
                $style = $f->getAttribute('style');
                $tempUrl = substr($style, 21, -2);
                $country = substr($tempUrl, 11, -4);
                $url = "http://www.coin-database.com" . $tempUrl;
                if ($url != "http://www.coin-database.com")
                {
                    DB::table('coins')->insert(
                        ['description' => $description[$i]->nodeValue, 'country' => $country, 'year' => $header[$i]->nodeValue, 'img' => $slike[$i]->getAttribute("src")]
                        );
                    $i++;
                }
            }
        }
  */    
        $coins = DB::select('select * from coins');
        $User = User::where('email', Auth::user()->email)->get()->first();
        $users_coins = DB::select('select * from users_coins where id_user = ?', [$User->id]);
        $all = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->sum('number_of_coins');
        $unique = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->count('id_coin');

        Session::put(['albumEditing', 'false']);

        return view('profile', ['coins'=> $coins, 'users_coins' => $users_coins, 'all' => $all, 'unique'=>$unique]);
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

		//return redirect('/profile');
        $coins = DB::select('select * from coins');
        $User = User::where('email', Auth::user()->email)->get()->first();
        $users_coins = DB::select('select * from users_coins where id_user = ?', [$User->id]);

        $all = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->sum('number_of_coins');
        $unique = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->count('id_coin');

        Session::put(['albumEditing', 'false']);

		return redirect()->route('profile', ['coins'=> $coins, 'users_coins' => $users_coins, 'all' => $all, 'unique'=>$unique]);
    }

    public function seeLocation() {
    	$User = User::where('email', Auth::user()->email)->get()->first();
    	$lat = $User->lat;
    	$lang = $User->lang;
    	return view("locationShower", compact('lat', 'lang'));
    }

    public function achivements() {
        $User = User::where('email', Auth::user()->email)->get()->first();
        $achivements = DB::select('select * from achivements');
        $users_achivements = DB::select('select * from users_achivements where id_user = ?', [$User->id]);

        $all = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->sum('number_of_coins');

        $unique = DB::table('users_coins')
                     ->where('id_user', [$User->id])
                     ->count('id_coin');

        if($all >= 100)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 6]);
        if($all >= 50)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 5]);
        if($all >= 20)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 4]);
        if($all >= 10)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 3]);
        if($all >= 5)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 2]);
        if($all >= 1)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 1]);

        if($unique >= 100)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 12]);
        if($unique >= 50)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 11]);
        if($unique >= 20)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 10]);
        if($unique >= 10)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 9]);
        if($unique >= 5)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 8]);
        if($unique >= 1)
            DB::table('users_achivements')->insert(['id_user' => $User->id, 'id_achivement' => 7]);

        $praviDosezki = DB::table('users_achivements')->select('id_achivement')->where('id_user', [$User->id])->distinct()->orderBy('id_achivement', 'asc')->get();

        return view('achivements', ['achivements'=> $achivements, 'users_achivements' => $praviDosezki]);
    }
}
