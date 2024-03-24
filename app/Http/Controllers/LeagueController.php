<?php

namespace App\Http\Controllers;

use App\Models\Prono;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Response;

class LeagueController extends Controller
{
	public function index(){
		$all_users = User::all();
		$league = collect();
		foreach ($all_users as $user) {
			$tmp = array(
				'name' => $user->name,
				'pronos_total' => Prono::where('user_id', $user->id)->where('is_counted', 1)->count(),
				'pronos_won' => Prono::where('user_id', $user->id)->where('is_counted', 1)->where('is_won', 1)->count(),
				'pronos_exact' => Prono::where('user_id', $user->id)->where('is_counted', 1)->where('is_exact', 1)->count(),
				'score' => $user->total_points ?? 0,
			);
			$league->push($tmp);
		}

		$league = $league->sortByDesc(function($item){
			return $item['score'];
		});

		return view('md-league')->withLeague($league);
	}
}