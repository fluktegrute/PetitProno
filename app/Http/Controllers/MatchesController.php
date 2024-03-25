<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\PronoController;

use App\Models\ECMatch;
use App\Models\Team;
use App\Models\Prono;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Response;

class MatchesController extends Controller
{
	public function __construct(){
		$this->api = new ApiController();
	}

	public function update(Request $request){
		HelpController::checkToken($request->input('token'));
		$all_matches = $this->api->call('matches');
		foreach ($all_matches->matches as $api_match) {
			if(!is_null($api_match->homeTeam->id) && !is_null($api_match->awayTeam->id)){
				$match = ECMatch::where('api_id', $api_match->id)->first();
				if(is_null($match)){
					$dt = new \DateTime($api_match->utcDate, new \DateTimeZone('UTC'));
					$dt->setTimezone(new \DateTimeZone(config('app.app_timezone')));

					$match = new ECMatch;
					$match->api_id = $api_match->id;
					$match->date = $dt->format('Y-m-d H:i:s');
					$match->stage = $api_match->stage;
					$match->group = $api_match->group;
					$match->home_team = $api_match->homeTeam->id;
					$match->away_team = $api_match->awayTeam->id;
		            $match->home_goals = 0;
		            $match->away_goals = 0;
					$match->save();
				}
				else{
					if(!property_exists($api_match->score, 'regularTime')){
						$match->home_goals = $api_match->score->regularTime->home ?? 0;
						$match->away_goals = $api_match->score->regularTime->home ?? 0;
					}
					else{
						$match->home_goals = $api_match->score->fulltime->home ?? 0;
						$match->away_goals = $api_match->score->fulltime->home ?? 0;
					}
					$match->winner = $api_match->score->winner;
					$match->save();

					$winner = false;
					if($api_match->stage == 'FINAL'){
						$winner = Team::where('api_id', $api_match->season->winner->id)->first();
						if($winner){
							$winner->is_winner = 1;
							$winner->save();
						}
					}
					if(strtotime($match->date) < strtotime('now'))
						PronoController::update($match, $winner);
				}
			}
		}
	}

	public function index(){
		$user_id = auth()->user()->id;
		$all_matches = ECMatch::orderBy('date')->get();
		$matches = [];
		$has_winner = !is_null(auth()->user()->prono_winner);
		foreach ($all_matches as $match) {
			$prono = Prono::where('user_id', $user_id)->where('match_id', $match->id)->first();

			$home_team = Team::where('api_id', $match->home_team)->first();
			$away_team = Team::where('api_id', $match->away_team)->first();
			$matches[] = [
				'id' => $match->id,
				'stage' => $match->stage(),
				'group' => $match->group(),
				'home_team' => [
					'id' => $match->home_team,
					'name' => $home_team->name(),
					'score' => $match->home_goals,
					'flag' => $home_team->flag,
					'prono' => $prono->home_team_goals ?? '',
				],
				'away_team' => [
					'id' => $match->away_team,
					'name' => $away_team->name(),
					'score' => $match->away_goals,
					'flag' => $away_team->flag,
					'prono' => $prono->away_team_goals ?? '',
				],
				'date' => date('d/m/Y à H\hi', strtotime($match->date)),
				'is_available' => strtotime($match->date) > strtotime('now'),
				'prono_result' => $prono ? ($prono->is_exact ? 2 : ($prono->is_won ? 1 : 0)) : -1,
				'prono_booster' => $prono ? $prono->booster_used : false,
			];
		}
		return view('matches')->withMatches($matches)->withHasWinner($has_winner);
	}
}