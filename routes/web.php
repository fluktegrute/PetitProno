<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\StagingController;
use App\Http\Controllers\PronoController;
use App\Http\Controllers\LeagueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [MatchesController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('update-winner', [PronoController::class, 'setWinner'])->name('winner.update');

    Route::get('staging', [StagingController::class, 'index'])->name('staging');
    Route::get('league/{id?}', [LeagueController::class, 'index'])->name('league');

    Route::post('league-create', [LeagueController::class, 'create'])->name('league.create');

    Route::post('set-prono', [PronoController::class, 'setScore'])->name('set-prono');
    Route::post('set-booster', [PronoController::class, 'setBooster'])->name('set-booster');
});

Route::get('update-teams', [TeamsController::class, 'update'])->name('update_teams');
Route::get('update-matches', [MatchesController::class, 'update'])->name('update_matches');

require __DIR__.'/auth.php';
