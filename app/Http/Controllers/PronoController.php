<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelpController;

use App\Models\Prono;
use App\Models\ECMatch;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use Response;

class PronoController extends Controller
{
	public function setScore(Request $request){
		$user_id = auth()->user()->id;
		$prono = Prono::where('user_id', $user_id)
					->where('match_id', $request->match_id)
					->first();

		$match = ECMatch::find($request->match_id);
		if(strtotime($match->date) < strtotime('now')){
			$user = User::find($user_id);
			$user->total_points -= config('app.cheating_points_to_remove');
			$user->save();
			echo ('triche|'.config('app.cheating_points_to_remove'));
			die();
		}

		if(!$prono){
			$prono = new Prono;
			$prono->user_id = $user_id;
			$prono->match_id = $request->match_id;
		}

		if($request->equipe == 'home'){
			$prono->home_team_goals = $request->score;
			$prono->away_team_goals = $prono->away_team_goals ?? 0;
		}
		else{
			$prono->away_team_goals = $request->score;
			$prono->home_team_goals = $prono->home_team_goals ?? 0;
		}

		$prono->save();

		echo 'ok';
	}

	public function setBooster(Request $request){
		$user_id = auth()->user()->id;
		$prono = Prono::where('user_id', $user_id)
					->where('match_id', $request->match_id)
					->first();

		$user = User::find($user_id);

		if(!$prono){
			$prono = new Prono;
			$prono->user_id = $user_id;
			$prono->match_id = $request->match_id;
		}

		$booster_used = $request->booster == "true" ? 1 : 0;
		$user_boosters = Prono::where('user_id', $user_id)->where('booster_used', 1)->count();

		if(($booster_used && $user_boosters < config('app.initial_booster_quantity')) || !$booster_used) {
			$prono->booster_used = $booster_used;
			$prono->home_team_goals = $prono->home_team_goals ?? 0;
			$prono->away_team_goals = $prono->away_team_goals ?? 0;
			$prono->save();			
			echo 'ok';
			die();
		}
		elseif ($booster_used && $user_boosters >= config('app.initial_booster_quantity')) {
			echo 'no_more_boosters';
			die();
		}
	}

	public static function update($match, $winner){
		$pronos = Prono::where('match_id', $match->id)->where('is_counted', 0)->get();
		foreach ($pronos as $prono) {
			$user = User::find($prono->user_id);
			if($prono->home_team_goals == $match->home_goals && $prono->away_team_goals == $match->away_goals){
				$prono->is_exact = 1;
				$prono->is_won = 0;
				$prono->is_counted = 1;
				$prono->save();

				$user->total_points += $prono->booster_used ? config('app.booster_multiplier') * config('app.exact_score_points') : config('app.exact_score_points');
				$user->save();
			}
			elseif(
				($prono->home_team_goals > $prono->away_team_goals
				&& $match->home_goals > $match->away_goals)
				|| ($prono->home_team_goals < $prono->away_team_goals
				&& $match->home_goals < $match->away_goals)
				|| ($prono->home_team_goals == $prono->away_team_goals
				&& $match->home_goals == $match->away_goals)
			){
				$prono->is_exact = 0;
				$prono->is_won = 1;
				$prono->is_counted = 1;
				$prono->save();

				$user->total_points += $prono->booster_used ? config('app.booster_multiplier') * config('app.winning_prono_points') : config('app.winning_prono_points');
				$user->save();
			}
			else{
				$prono->is_exact = 0;
				$prono->is_won = 0;
				$prono->is_counted = 1;
				$prono->save();
			}
		}

		if($winner){
			$users_with_correct_winner = User::where('prono_winner', $winner->id)->where('bonus_given', 0)->get();
			foreach ($users_with_correct_winner as $user_with_correct_winner) {
				$user_with_correct_winner->total_points += config('app.winner_prono_points');
				$user_with_correct_winner->bonus_given = 1;
				$user_with_correct_winner->save();
			}
		}
	}

	public function setWinner(Request $request){
		$user_id = auth()->user()->id;
		$user = User::find($user_id);
		$user->prono_winner = $request->set_winner;
		$user->save();
		return Redirect::route('profile.edit')->with('status', 'winner-updated');
	}
}