<?php

namespace App\Http\Controllers;

use App\Models\Prono;
use App\Models\User;
use App\Models\League;
use App\Models\UserLeague;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Response;

class LeagueController extends Controller
{
	public function index($id = 0){
		$requested_league = League::find($id);
		
		if($requested_league){
			$user_in_league = UserLeague::where('league_id', $id)->where('user_id', auth()->user()->id)->first();
			if(!$user_in_league)
				return view('league')->withError(true);

			$league_name = $requested_league->name;
			$creator = User::find($requested_league->created_by);
			$creator_name = $creator->name;

			$comments = Comment::where('league_id', $id)->orderByDesc('comment_date')->get();

			$user_is_creator = false;
			if($creator->id == auth()->user()->id)
				$user_is_creator = true;

			$user_leagues = UserLeague::where('league_id', $id)->get();
			$all_users = [];
			foreach ($user_leagues as $user_league) {
				$all_users[] = User::find($user_league->user_id);
			}
		}
		else{
			$league_name = "Générale";
			$creator_name = false;
			$user_is_creator = false;
			$all_users = User::all();
			$comments = false;
		}
		
		$league = collect();
		foreach ($all_users as $user) {
			$tmp = array(
				'user_id' => $user->id,
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

		return view('league')
			->withLeague($league)
			->withLeagueName($league_name)
			->withLeagueId($id)
			->withCreator($creator_name)
			->withUserIsCreator($user_is_creator)
			->withError(false)
			->withComments($comments);
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

	public function join(Request $request){
		$user_id = auth()->user()->id;

		$user_league = UserLeague::where('user_id', $user_id)->where('league_id', $request->league_id)->first();
		
		if($user_league){
			return Redirect::route('profile.edit')->with('status', 'already-joined');
		}

		$user_league = new UserLeague;
		$user_league->league_id = $request->league_id;
		$user_league->user_id = $user_id;
		$user_league->save();

		return Redirect::route('profile.edit')->with('status', 'league-joined');
	}

	public function delete($id){
		$league = League::find($id);
		if(auth()->user()->id == $league->created_by){
			$league->delete();
			UserLeague::where('league_id', $id)->delete();
		}
		return Redirect::route('league');
	}

	public function remove_user($league_id, $user_id){
		$league = League::find($league_id);
		if(auth()->user()->id == $league->created_by)
			UserLeague::where('league_id', $league_id)->where('user_id', $user_id)->delete();
		return Redirect::route('league', ['id' => $league_id]);
	}

	public function post_comment(Request $request){
		if(!is_null($request->content)){
			$comment = new Comment;
			$comment->league_id = $request->league_id;
			$comment->user_id = auth()->user()->id;
			$comment->comment_date = date("Y-m-d H:i:s");
			$comment->comment = $request->content;
			$comment->save();
		}
		return Redirect::route('league', ['id' => $request->league_id]);
	}

	public function upload_image(Request $request){
	    if($request->hasFile('file')) {
	        //get filename with extension
	        $filenamewithextension = $request->file('file')->getClientOriginalName();

	        //get filename without extension
	        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

	        //get file extension
	        $extension = $request->file('file')->getClientOriginalExtension();

	        //filename to store
	        $filenametostore = $filename.'_'.time().'.'.$extension;

	        //Upload File
	        $request->file('file')->storeAs('public/uploads', $filenametostore);

	        // you can save image path below in database
	        $path = asset('storage/uploads/'.$filenametostore);

	        echo $path;
	        exit;
	    }
	}
}