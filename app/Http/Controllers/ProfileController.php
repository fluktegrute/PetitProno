<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Team;
use App\Models\League;
use App\Models\User;

use App\Http\Controllers\HelpController;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $teams = false;
        $has_winner = false;

        $all_leagues = League::orderBy('name')->get();
        $leagues = [];
        foreach ($all_leagues as $league) {
            $creator = User::find($league->created_by);
            $leagues[] = [
                'id' => $league->id,
                'name' => $league->name,
                'created_by' => $creator->name,
            ];
        }

        if(is_null($request->user()->prono_winner)) {
            $teams = Team::all();
            $teams = $teams->sortBy(function($team) {
                $team->name = $team->name();
                return $team->name;
            });
        }
        else{
            $has_winner = Team::where('id', $request->user()->prono_winner)->first();
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'teams' => $teams,
            'has_winner' => $has_winner ? $has_winner->name() : null,
            'leagues' => $leagues,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
