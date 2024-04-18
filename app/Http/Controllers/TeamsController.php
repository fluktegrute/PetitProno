<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TeamsController extends Controller
{
	public function __construct(){
		$this->api = new ApiController();
	}

	public function update(Request $request){
		HelpController::checkToken($request->input('token'));
		
		$all_teams = $this->api->call('standings');

		$updated = 0;
		$created = 0;

		foreach ($all_teams->standings as $group) {
			foreach ($group->table as $api_team) {
				if(!is_null($api_team->team->id)){
					$team = Team::where('api_id', $api_team->team->id)->first();
					if(is_null($team)){
						$team = new Team;
						$team->api_id = $api_team->team->id;
						$team->name = $api_team->team->shortName;
						$team->flag = $api_team->team->crest;
						$team->position = $api_team->position;
						$team->group = $group->group;
						$team->save();
						$created++;
					}
					else{
						$team->position = $api_team->position;
						$team->played = $api_team->playedGames;
						$team->won = $api_team->won;
						$team->draw = $api_team->draw;
						$team->lost = $api_team->lost;
						$team->points = $api_team->points;
						$team->goals_for = $api_team->goalsFor;
						$team->goals_against = $api_team->goalsAgainst;
						$team->goal_diff = $api_team->goalDifference;
						$team->save();
						$updated++;
					}
				}
			}
		}
		echo "Teams created: $created<br>";
		echo "Teams updated: $updated<br>";
	}
}