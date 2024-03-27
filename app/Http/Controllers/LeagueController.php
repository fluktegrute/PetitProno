<?php

namespace App\Http\Controllers;

use App\Models\Prono;
use App\Models\User;
use App\Models\League;
use App\Models\UserLeague;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Response;

class LeagueController extends Controller
{
	public function index($id = 0){
		$league = League::find($id);
		if($league){
			$league_name = $league->name;
			$creator = User::find($league->created_by);
			$creator_name = $creator->name;

			$user_leagues = UserLeague::where('league_id', $id)->get();
			$all_users = [];
			foreach ($user_leagues as $user_league) {
				$all_users[] = User::find($user_league->user_id);
			}
		}
		else{
			$league_name = "Générale";
			$creator_name = false;
			$all_users = User::all();
		}
		
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

		return view('md-league')->withLeague($league)->withLeagueName($league_name)->withCreator($creator_name);
	}

	public function create(Request $request){
		$user_id = auth()->user()->id;
		$league = new League;
		$league->name = $request->league_name;
		$league->created_by = $user_id;
		$league->save();

		$user_league = new UserLeague;
		$user_league->league_id = $league->id;
		$user_league->user_id = $user_id;
		$user_league->save();

		return Redirect::route('profile.edit')->with('status', 'league-created');
	}
}