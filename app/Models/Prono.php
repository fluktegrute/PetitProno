<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prono extends Model
{

    protected $table = 'pronos';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'match_id',
        'booster_used',
        'home_team_goals',
        'away_team_goals',
        'is_exact',
        'is_won',
    ];

    public $timestamps;
}
