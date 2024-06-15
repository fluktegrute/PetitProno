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
						'name' => $team->name(),
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

		$bracket = [
			'last_16_1' => [
				$groups['A'][0],
				$groups['C'][1],
			],
			'last_16_2' => [
				$groups['B'][0],
				['name' => 'TBD'],
			],
			'last_16_3' => [
				$groups['D'][1],
				$groups['E'][1],
			],
			'last_16_4' => [
				$groups['F'][0],
				['name' => 'TBD'],
			],
			'last_16_5' => [
				$groups['A'][1],
				$groups['B'][1],
			],
			'last_16_6' => [
				$groups['C'][0],
				['name' => 'TBD'],
			],
			'last_16_7' => [
				$groups['E'][0],
				['name' => 'TBD'],
			],
			'last_16_8' => [
				$groups['D'][0],
				$groups['F'][1],
			],
		];

		return view('staging')->withGroups($groups)->withBracket($bracket);
	}
}