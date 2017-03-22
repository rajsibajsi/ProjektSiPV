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

        Session::put(['albumEditing', 'false']);

        return view('profile', ['coins'=> $coins]);
    }

    public function goToLocation() {
    	return view("locationSelector");
    }

    public function saveLocation(Request $request) {
	    $User = User::where('email', Auth::user()->email)->get()->first();
		$User->lat = $request->input('lat');
		$User->lang = $request->input('lang');

		$User->save();

		return view("profile");
    }

    public function seeLocation() {
    	$User = User::where('email', Auth::user()->email)->get()->first();
    	$lat = $User->lat;
    	$lang = $User->lang;
    	return view("locationShower", compact('lat', 'lang'));
    }
}
