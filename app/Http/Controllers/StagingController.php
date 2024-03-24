<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelpController;

use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Response;

class StagingController extends Controller
{
	public function index(){
		$all_teams = Team::orderBy('position')->get();
		$groups = [];
		foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $group) {
			foreach ($all_teams as $team) {
				if($team->group == "Group $group"){
					$groups[$group][] = [
						'name' => HelpController::equipe($team->name),
						'flag' => $team->flag,
						'played' => $team->played,
						'won' => $team->won,
						'draw' => $team->draw,
						'lost' => $team->lost,
						'points' => $team->points,
						'goals_for' => $team->goals_for,
						'goals_against' => $team->goals_against,
						'goal_diff' => $team->goal_diff,
					];
				}
			}
		}
		return view('staging')->withGroups($groups);
	}
}