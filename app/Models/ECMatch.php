<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ECMatch extends Model
{

    protected $table = 'matches';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'api_id',
        'date',
        'stage',
        'group',
        'home_team',
        'away_team',
        'winner',
        'home_goals',
        'away_goals',
    ];

    public $timestamps;

    public function home_team(){
        return $this->belongsTo(Team::class, 'home_team', 'api_id');
    }

    public function away_team(){
        return $this->belongsTo(Team::class, 'away_team', 'api_id');
    }
}
