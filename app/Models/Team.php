<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'teams';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'api_id',
        'name',
        'group',
        'position',
        'flag',
        'played',
        'won',
        'draw',
        'lost',
        'points',
        'goals_for',
        'goals_against',
        'goal_diff',
        'is_winner',
    ];

    public $timestamps;
}
